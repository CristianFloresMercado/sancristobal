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
        Schema::create('touristsites', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->mediumText('resumen')->nullable();
            $table->string('imagen_destacada')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->boolean('publicado')->default(false);
            $table->string('ubicacion');
            $table->string('coordenadas')->nullable(); // ejemplo: "-21.567, -66.123"
            $table->text('horario')->nullable();
            $table->json('galeria_imagenes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('touristsites');
    }
};
