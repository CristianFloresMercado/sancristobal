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
        Schema::create('negocios', function (Blueprint $table) {
            $table->id();

            $table->foreignId('categoria_id')
                ->constrained('categorias')
                ->onDelete('cascade');

            $table->foreignId('subcategoria_id')
                ->nullable()
                ->constrained('subcategorias')
                ->nullOnDelete();

            $table->string('nombre');

            $table->string('slug')->unique();

            $table->text('descripcion')->nullable();

            $table->string('logo')->nullable();

            $table->string('foto_principal')->nullable();

            $table->string('direccion')->nullable();

            $table->decimal('latitud', 10, 7)->nullable();
            $table->decimal('longitud', 10, 7)->nullable();

            $table->string('telefono')->nullable();

            $table->string('whatsapp')->nullable();

            $table->string('correo')->nullable();

            $table->string('sitio_web')->nullable();

            $table->string('facebook')->nullable();

            $table->string('instagram')->nullable();

            $table->string('tiktok')->nullable();

            $table->string('horario')->nullable();

            $table->enum('plan', ['gratis', 'premium'])
                ->default('gratis');

            $table->boolean('publicado')
                ->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('negocios');
    }
};
