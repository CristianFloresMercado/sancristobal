<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('negocios', function (Blueprint $table) {
            $table->enum('plan_estado', ['activo', 'inactivo', 'pendiente'])->default('inactivo')->after('plan');
            $table->date('plan_fecha_fin')->nullable()->after('plan_estado');
        });
    }

    public function down(): void
    {
        Schema::table('negocios', function (Blueprint $table) {
            $table->dropColumn(['plan_estado', 'plan_fecha_fin']);
        });
    }
};
