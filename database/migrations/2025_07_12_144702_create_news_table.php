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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('resumen')->nullable();
            $table->string('imagen_destacada')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->boolean('publicado')->default(false);
            $table->string('autor')->nullable();
            $table->string('fuente')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
