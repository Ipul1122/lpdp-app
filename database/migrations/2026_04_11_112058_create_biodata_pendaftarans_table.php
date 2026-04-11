<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('biodata_pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('deskripsi_diri')->nullable();
            $table->text('riwayat_pendidikan')->nullable();
            $table->text('pengalaman_kerja')->nullable();
            $table->text('pengalaman_organisasi')->nullable();
            $table->text('prestasi')->nullable();
            $table->text('keahlian')->nullable();
            $table->text('bahasa')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('biodata_pendaftarans');
    }
};