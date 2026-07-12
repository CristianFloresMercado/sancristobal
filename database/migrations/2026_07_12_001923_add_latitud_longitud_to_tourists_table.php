<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tourists', function (Blueprint $table) {
            $table->decimal('latitud', 10, 7)->nullable()->after('ubicacion');
            $table->decimal('longitud', 10, 7)->nullable()->after('latitud');
            $table->string('direccion')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('tourists', function (Blueprint $table) {
            $table->dropColumn(['latitud', 'longitud']);
        });
    }
};
