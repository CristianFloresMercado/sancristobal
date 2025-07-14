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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_comunidad');
            $table->text('descripcion')->nullable();
            $table->string('alcalde')->nullable();
            $table->string('telefono_municipal')->nullable();
            $table->string('direccion_municipal')->nullable();
            $table->string('hospital_principal')->nullable();
            $table->string('direccion_hospital')->nullable();
            $table->string('telefono_hospital')->nullable();
            $table->string('telefono_bomberos')->nullable();
            $table->string('telefono_policia')->nullable();
            $table->string('telefono_emergencia')->nullable();
            $table->text('horarios_atencion')->nullable();
            $table->json('enlaces_utiles')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
