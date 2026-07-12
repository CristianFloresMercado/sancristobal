<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Negocio;
use App\Models\Pago;
use Illuminate\Http\Request;
use Carbon\Carbon;
class PagoController extends Controller
{
    public function index(Request $request)
    {
        $query = Pago::with('negocio');
        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }
        $pagos = $query->latest()->paginate(15);
        $negociosVencidos = Negocio::where('plan_estado', 'activo')
            ->where('plan_fecha_fin', '<=', Carbon::now()->addDays(7))
            ->where('plan_fecha_fin', '>', Carbon::now())
            ->get();
        $negociosExpirados = Negocio::where('plan_estado', 'activo')
            ->where('plan_fecha_fin', '<=', Carbon::now())
            ->get();
        foreach ($negociosExpirados as $neg) {
            $neg->update(['plan' => 'none', 'plan_estado' => 'inactivo', 'publicado' => false]);
        }
        return view('admin.pagos.index', compact('pagos', 'negociosVencidos'));
    }
    public function create()
    {
        $negocios = Negocio::orderBy('nombre')->get();
        return view('admin.pagos.create', compact('negocios'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'negocio_id' => 'required|exists:negocios,id',
            'tipo_plan' => 'required|in:mensual,anual',
            'monto' => 'required|numeric|min:0',
            'fecha_pago' => 'required|date',
            'comprobante' => 'nullable|image|max:2048',
            'observaciones' => 'nullable|string',
        ]);
        $fechaInicio = Carbon::now();
        $fechaFin = $validated['tipo_plan'] === 'mensual' ? $fechaInicio->copy()->addMonth() : $fechaInicio->copy()->addYear();
        $validated['fecha_inicio'] = $fechaInicio;
        $validated['fecha_fin'] = $fechaFin;
        $validated['estado'] = 'pendiente';
        if ($request->hasFile('comprobante')) {
            $validated['comprobante'] = $request->file('comprobante')->store('pagos/comprobantes', 'public');
        }
        Pago::create($validated);
        session()->flash('swal', ['icon' => 'success', 'title' => '¡Registrado!', 'text' => 'Pago registrado, pendiente de aprobación.']);
        return redirect()->route('admin.pagos.index');
    }
    public function edit(Pago $pago)
    {
        $negocios = Negocio::orderBy('nombre')->get();
        return view('admin.pagos.edit', compact('pago', 'negocios'));
    }
    public function update(Request $request, Pago $pago)
    {
        $validated = $request->validate([
            'negocio_id' => 'required|exists:negocios,id',
            'tipo_plan' => 'required|in:mensual,anual',
            'monto' => 'required|numeric|min:0',
            'fecha_pago' => 'required|date',
            'comprobante' => 'nullable|image|max:2048',
            'observaciones' => 'nullable|string',
            'estado' => 'required|in:pendiente,aprobado,rechazado',
        ]);
        $fechaInicio = $pago->fecha_inicio;
        $fechaFin = $validated['tipo_plan'] === 'mensual' ? $fechaInicio->copy()->addMonth() : $fechaInicio->copy()->addYear();
        $validated['fecha_inicio'] = $fechaInicio;
        $validated['fecha_fin'] = $fechaFin;
        if ($request->hasFile('comprobante')) {
            if ($pago->comprobante && \Storage::disk('public')->exists($pago->comprobante)) {
                \Storage::disk('public')->delete($pago->comprobante);
            }
            $validated['comprobante'] = $request->file('comprobante')->store('pagos/comprobantes', 'public');
        }
        $pago->update($validated);
        if ($validated['estado'] === 'aprobado') {
            $pago->negocio->update([
                'plan' => $pago->tipo_plan,
                'plan_estado' => 'activo',
                'plan_fecha_fin' => $pago->fecha_fin,
                'publicado' => true,
            ]);
        } elseif ($validated['estado'] === 'rechazado') {
            $pago->negocio->update(['plan' => 'none', 'plan_estado' => 'inactivo', 'publicado' => false]);
        }
        session()->flash('swal', ['icon' => 'success', 'title' => '¡Actualizado!', 'text' => 'Pago actualizado correctamente.']);
        return redirect()->route('admin.pagos.index');
    }
    public function aprobar(Pago $pago)
    {
        $pago->update(['estado' => 'aprobado']);
        $pago->negocio->update([
            'plan' => $pago->tipo_plan,
            'plan_estado' => 'activo',
            'plan_fecha_fin' => $pago->fecha_fin,
            'publicado' => true,
        ]);
        if (request()->expectsJson()) {
            return response()->json(['message' => 'El negocio fue activado.']);
        }
        session()->flash('swal', ['icon' => 'success', 'title' => '¡Aprobado!', 'text' => 'El negocio fue activado.']);
        return redirect()->route('admin.pagos.index');
    }
    public function rechazar(Pago $pago)
    {
        $pago->update(['estado' => 'rechazado']);
        $pago->negocio->update(['plan' => 'none', 'plan_estado' => 'inactivo', 'publicado' => false]);
        if (request()->expectsJson()) {
            return response()->json(['message' => 'El pago fue rechazado.']);
        }
        session()->flash('swal', ['icon' => 'info', 'title' => 'Rechazado', 'text' => 'El pago fue rechazado.']);
        return redirect()->route('admin.pagos.index');
    }
    public function destroy(Pago $pago)
    {
        $pago->delete();
        session()->flash('swal', ['icon' => 'success', 'title' => '¡Eliminado!', 'text' => 'Pago eliminado.']);
        return redirect()->route('admin.pagos.index');
    }
}
