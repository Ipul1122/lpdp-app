<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('industri_pendukungs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('unit_kerja')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('golongan')->nullable();
            $table->string('nama_instansi')->nullable();
            $table->string('tanggal_mulai_kerja')->nullable();
            $table->string('tanggal_pensiun')->nullable();
            $table->string('surat_izin')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('industri_pendukungs');
    }
};