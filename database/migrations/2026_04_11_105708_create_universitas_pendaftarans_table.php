<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('universitas_pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('negara_tujuan')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('kota')->nullable();
            $table->string('nama_universitas')->nullable();
            $table->string('program_studi')->nullable();
            $table->string('tanggal_mulai_studi')->nullable();
            $table->integer('durasi_studi')->nullable(); // Durasi dalam bulan
            $table->string('loa')->nullable(); // File path LoA
            $table->string('khs_ipk')->nullable(); // File path KHS/IPK
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('universitas_pendaftarans');
    }
};