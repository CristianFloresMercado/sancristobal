<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use ZipArchive;

class BackupController extends Controller
{
    public function index()
    {
        $backupsPath = storage_path('app/backups');
        $backups = [];

        if (File::isDirectory($backupsPath)) {
            $files = collect(File::files($backupsPath))
                ->filter(fn($f) => $f->getExtension() === 'zip')
                ->sortByDesc('filename')
                ->values();

            foreach ($files as $file) {
                $backups[] = [
                    'name' => $file->getFilename(),
                    'size' => $this->formatSize($file->getSize()),
                    'date' => $file->getMTime(),
                    'path' => $file->getPathname(),
                ];
            }
        }

        return view('admin.backups.index', compact('backups'));
    }

    public function create()
    {
        $backupsPath = storage_path('app/backups');
        File::makeDirectory($backupsPath, 0755, true, true);

        $dbName = config('database.connections.mysql.database');
        $timestamp = date('Y-m-d_H-i-s');
        $sqlFilename = "backup_{$timestamp}.sql";
        $zipFilename = "backup_{$timestamp}.zip";
        $sqlPath = $backupsPath . '/' . $sqlFilename;
        $zipPath = $backupsPath . '/' . $zipFilename;

        try {
            $sql = $this->generateSqlDump($dbName);
            file_put_contents($sqlPath, $sql);
        } catch (\Exception $e) {
            return back()->withErrors(['backup' => 'Error al generar backup: ' . $e->getMessage()]);
        }

        if (class_exists(ZipArchive::class)) {
            $zip = new ZipArchive();
            if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
                $zip->addFile($sqlPath, $sqlFilename);
                $zip->close();
                @unlink($sqlPath);
                $finalFile = $zipPath;
                $finalName = $zipFilename;
            } else {
                $finalFile = $sqlPath;
                $finalName = $sqlFilename;
            }
        } else {
            $finalFile = $sqlPath;
            $finalName = $sqlFilename;
        }

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Backup creado',
            'text' => "Backup generado: {$finalName} (" . $this->formatSize(File::size($finalFile)) . ")",
        ]);

        return redirect()->route('admin.backups.index');
    }

    public function download($filename)
    {
        $path = storage_path('app/backups/' . $filename);

        if (!File::exists($path)) {
            abort(404, 'Backup no encontrado');
        }

        return response()->download($path);
    }

    public function destroy($filename)
    {
        $path = storage_path('app/backups/' . $filename);

        if (File::exists($path)) {
            File::delete($path);
        }

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Eliminado',
            'text' => 'El backup fue eliminado.',
        ]);

        return redirect()->route('admin.backups.index');
    }

    public function restore(Request $request)
    {
        $request->validate([
            'backup_file' => 'required|file',
        ], [
            'backup_file.required' => 'Debe seleccionar un archivo.',
            'backup_file.file' => 'El archivo no es válido.',
        ]);

        $file = $request->file('backup_file');
        $extension = strtolower($file->getClientOriginalExtension());

        if (!in_array($extension, ['sql', 'zip'])) {
            return back()->withErrors(['backup_file' => 'Formato no permitido. Use archivos .sql o .zip']);
        }

        $sqlPath = null;

        try {
            if ($extension === 'zip') {
                $zip = new ZipArchive();
                $tempPath = $file->getRealPath();
                if ($zip->open($tempPath) === true) {
                    for ($i = 0; $i < $zip->numFiles; $i++) {
                        $name = $zip->getNameIndex($i);
                        if (strtolower(pathinfo($name, PATHINFO_EXTENSION)) === 'sql') {
                            $sqlContent = $zip->getFromName($name);
                            $sqlPath = storage_path('app/backups/_restore_temp.sql');
                            file_put_contents($sqlPath, $sqlContent);
                            break;
                        }
                    }
                    $zip->close();
                } else {
                    return back()->withErrors(['backup_file' => 'No se pudo abrir el archivo ZIP.']);
                }

                if (!$sqlPath || !File::exists($sqlPath)) {
                    return back()->withErrors(['backup_file' => 'El ZIP no contiene ningún archivo .sql.']);
                }
            } else {
                $sqlPath = storage_path('app/backups/_restore_temp.sql');
                $file->move(storage_path('app/backups'), '_restore_temp.sql');
            }

            $pdo = DB::connection()->getPdo();
            $dbName = config('database.connections.mysql.database');

            $pdo->exec("SET FOREIGN_KEY_CHECKS=0");
            $pdo->exec("SET NAMES utf8mb4");

            $lines = file($sqlPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            $current = '';
            $inString = false;
            $stringChar = '';

            foreach ($lines as $line) {
                $trimmedLine = trim($line);

                if ($trimmedLine === '' || str_starts_with($trimmedLine, '--') || str_starts_with($trimmedLine, '/*')) {
                    continue;
                }

                $len = strlen($trimmedLine);
                for ($i = 0; $i < $len; $i++) {
                    $char = $trimmedLine[$i];

                    if ($inString) {
                        $current .= $char;
                        if ($char === $stringChar && ($i === 0 || $trimmedLine[$i - 1] !== '\\')) {
                            $inString = false;
                        }
                        continue;
                    }

                    if ($char === "'" || $char === '"') {
                        $inString = true;
                        $stringChar = $char;
                        $current .= $char;
                        continue;
                    }

                    if ($char === ';') {
                        $stmt = trim($current);
                        if (!empty($stmt) && strtoupper(substr($stmt, 0, 3)) !== 'SET') {
                            try {
                                $pdo->exec($stmt);
                            } catch (\Exception $e) {
                                continue;
                            }
                        }
                        $current = '';
                        continue;
                    }

                    $current .= $char;
                }

                if (!empty(trim($current)) && !$inString) {
                    $current .= "\n";
                }
            }

            $last = trim($current);
            if (!empty($last) && strtoupper(substr($last, 0, 3)) !== 'SET') {
                try {
                    $pdo->exec($last);
                } catch (\Exception $e) {
                    // skip
                }
            }

            $pdo->exec("SET FOREIGN_KEY_CHECKS=1");

            @unlink($sqlPath);

            session()->flash('swal', [
                'icon' => 'success',
                'title' => 'Backup restaurado',
                'text' => 'La base de datos fue restaurada correctamente.',
            ]);

        } catch (\Exception $e) {
            if ($sqlPath && File::exists($sqlPath)) @unlink($sqlPath);
            return back()->withErrors(['backup_file' => 'Error al restaurar: ' . $e->getMessage()]);
        }

        return redirect()->route('admin.backups.index');
    }

    private function generateSqlDump(string $dbName): string
    {
        $pdo = DB::connection()->getPdo();
        $tables = $this->getTables($dbName);

        $sql = "-- Backup de San Cristóbal\n";
        $sql .= "-- Fecha: " . date('Y-m-d H:i:s') . "\n";
        $sql .= "-- Base de datos: {$dbName}\n\n";
        $sql .= "SET FOREIGN_KEY_CHECKS=0;\n\n";

        foreach ($tables as $table) {
            $sql .= "-- Estructura de {$table}\n";
            $sql .= "DROP TABLE IF EXISTS `{$table}`;\n";

            $createRow = $pdo->query("SHOW CREATE TABLE `{$table}`")->fetch(\PDO::FETCH_NUM);
            if ($createRow) {
                $sql .= $createRow[1] . ";\n\n";
            }

            $sql .= "-- Datos de {$table}\n";
            $rows = $pdo->query("SELECT * FROM `{$table}`")->fetchAll(\PDO::FETCH_NUM);
            $columns = $pdo->query("SHOW COLUMNS FROM `{$table}`")->fetchAll(\PDO::FETCH_NUM);

            if (!empty($rows)) {
                $colNames = array_map(fn($c) => '`' . $c[0] . '`', $columns);
                $sql .= "INSERT INTO `{$table}` (" . implode(', ', $colNames) . ") VALUES\n";

                $valueRows = [];
                foreach ($rows as $row) {
                    $values = array_map(function ($val) use ($pdo) {
                        if ($val === null) return 'NULL';
                        return $pdo->quote($val);
                    }, $row);
                    $valueRows[] = '(' . implode(', ', $values) . ')';
                }
                $sql .= implode(",\n", $valueRows) . ";\n\n";
            }
        }

        $sql .= "SET FOREIGN_KEY_CHECKS=1;\n";

        return $sql;
    }

    private function getTables(string $dbName): array
    {
        $pdo = DB::connection()->getPdo();
        $rows = $pdo->query("SHOW TABLES FROM `{$dbName}`")->fetchAll(\PDO::FETCH_NUM);
        return array_map(fn($r) => $r[0], $rows);
    }

    private function formatSize($bytes)
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        $i = 0;
        while ($bytes >= 1024 && $i < count($units) - 1) {
            $bytes /= 1024;
            $i++;
        }
        return round($bytes, 1) . ' ' . $units[$i];
    }
}
