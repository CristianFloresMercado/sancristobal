<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE negocios MODIFY COLUMN plan VARCHAR(20) NOT NULL DEFAULT 'none'");
        DB::table('negocios')->where('plan', 'gratis')->update(['plan' => 'none']);
        DB::table('negocios')->where('plan', 'premium')->update(['plan' => 'none']);
        Schema::table('negocios', function (Blueprint $table) {
            $table->enum('plan', ['none', 'mensual', 'anual'])->default('none')->change();
        });
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE negocios MODIFY COLUMN plan VARCHAR(20) NOT NULL DEFAULT 'gratis'");
        DB::table('negocios')->where('plan', 'none')->update(['plan' => 'gratis']);
        Schema::table('negocios', function (Blueprint $table) {
            $table->enum('plan', ['gratis', 'premium'])->default('gratis')->change();
        });
    }
};
