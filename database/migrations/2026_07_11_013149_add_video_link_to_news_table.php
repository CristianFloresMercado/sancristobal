<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::table('news', function (Blueprint $table) {
            $table->string('video_link')->nullable()->after('fuente');
        });
    }
    public function down(): void {
        Schema::table('news', function (Blueprint $table) {
            $table->dropColumn('video_link');
        });
    }
};
