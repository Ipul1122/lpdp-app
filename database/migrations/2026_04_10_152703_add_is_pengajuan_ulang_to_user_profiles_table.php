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
    Schema::table('user_profiles', function (Blueprint $table) {
        $table->boolean('is_pengajuan_ulang')->default(false)->after('catatan');
    });
}

public function down(): void
{
    Schema::table('user_profiles', function (Blueprint $table) {
        $table->dropColumn('is_pengajuan_ulang');
    });
}
};
