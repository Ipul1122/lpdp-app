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
            $table->string('instansi')->nullable();
            $table->string('sektor')->nullable();
            $table->string('jenis_instansi')->nullable();
            $table->string('nama_instansi')->nullable();
            $table->string('telepon_instansi', 20)->nullable();
            $table->string('provinsi')->nullable();
            $table->string('kab_kota')->nullable();
            $table->text('alamat_instansi')->nullable();
            $table->string('status_kepegawaian')->nullable();
            $table->string('tanggal_mulai_kerja')->nullable(); // Pakai string karena inputnya "Bulan & Tahun"
            $table->string('pekerjaan')->nullable();
            $table->string('penghasilan')->nullable();
            $table->text('deskripsi_pekerjaan')->nullable();
            $table->string('surat_izin')->nullable(); // Untuk path file PDF/JPG
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('industri_pendukungs');
    }
};