<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('noticia_imagenes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('news_id')->constrained('news')->cascadeOnDelete();
            $table->string('imagen');
            $table->integer('orden')->default(0);
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('noticia_imagenes');
    }
};
