<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('tb_estado') && Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                $table->foreignId('estado_id')->after('profile_photo_path')->nullable()->constrained('tb_estado');
            });
        }
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['estado_id']);
            $table->dropColumn('estado_id');
        });
    }
};
