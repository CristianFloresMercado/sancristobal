<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('instituciones', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('tipo');
            $table->string('telefono')->nullable();
            $table->string('direccion')->nullable();
            $table->string('horario')->nullable();
            $table->string('contacto')->nullable();
            $table->text('descripcion')->nullable();
            $table->string('imagen')->nullable();
            $table->boolean('publicado')->default(true);
            $table->integer('orden')->default(0);
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('instituciones');
    }
};
