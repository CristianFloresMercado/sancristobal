<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('profesionales', function (Blueprint $table) {
            $table->string('localidad_nacimiento')->nullable()->after('sub_especialidad');
            $table->string('residencia_actual')->nullable()->after('localidad_nacimiento');
        });
    }

    public function down(): void
    {
        Schema::table('profesionales', function (Blueprint $table) {
            $table->dropColumn(['localidad_nacimiento', 'residencia_actual']);
        });
    }
};
