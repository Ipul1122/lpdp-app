<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Drop unique constraint pada nik terlebih dahulu agar modifikasi tipe kolom berjalan lancar di MySQL
        Schema::table('user_profiles', function (Blueprint $table) {
            try {
                // Drop unique index. Di MySQL, Laravel menamai indeks unik nik sebagai 'user_profiles_nik_unique'
                $table->dropUnique('user_profiles_nik_unique');
            } catch (\Exception $e) {
                // Abaikan jika tidak ada atau menggunakan SQLite
            }
        });

        // 2. Tambah kolom nik_hash dan ubah tipe kolom nik & alamat menjadi text
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->string('nik_hash', 64)->nullable()->unique()->after('nik');
            $table->text('nik')->nullable()->change();
            $table->text('alamat')->nullable()->change();
        });

        // 3. Enkripsi data NIK dan Alamat yang sudah ada di database saat ini, serta isi nik_hash
        try {
            $profiles = DB::table('user_profiles')->get();
            foreach ($profiles as $profile) {
                $update = [];
                
                // Jika nik tidak kosong dan belum terenkripsi (panjang <= 16)
                if (!empty($profile->nik) && strlen($profile->nik) <= 16) {
                    $decryptedNik = $profile->nik;
                    $update['nik'] = Crypt::encryptString($decryptedNik);
                    $update['nik_hash'] = hash('sha256', $decryptedNik);
                }
                
                // Jika alamat tidak kosong dan belum terenkripsi (tidak dimulai dengan format enkripsi base64 Laravel)
                if (!empty($profile->alamat) && !str_starts_with($profile->alamat, 'eyJpdiI6')) {
                    $update['alamat'] = Crypt::encryptString($profile->alamat);
                }

                if (!empty($update)) {
                    DB::table('user_profiles')->where('id', $profile->id)->update($update);
                }
            }
        } catch (\Exception $e) {
            // Log error atau abaikan jika tabel masih kosong / tidak bisa diakses saat migrasi
        }
    }

    public function down(): void
    {
        // Dekripsi data sebelum merubah kolom kembali ke tipe varchar semula
        try {
            $profiles = DB::table('user_profiles')->get();
            foreach ($profiles as $profile) {
                $update = [];
                
                if (!empty($profile->nik)) {
                    try {
                        $update['nik'] = substr(Crypt::decryptString($profile->nik), 0, 16);
                    } catch (\Exception $e) {
                        // abaikan jika gagal dekripsi
                    }
                }
                
                if (!empty($profile->alamat)) {
                    try {
                        $update['alamat'] = Crypt::decryptString($profile->alamat);
                    } catch (\Exception $e) {
                        // abaikan jika gagal dekripsi
                    }
                }

                if (!empty($update)) {
                    DB::table('user_profiles')->where('id', $profile->id)->update($update);
                }
            }
        } catch (\Exception $e) {
            // abaikan jika tabel kosong/error
        }

        Schema::table('user_profiles', function (Blueprint $table) {
            $table->string('nik', 16)->nullable()->unique()->change();
            $table->string('alamat')->nullable()->change();
            $table->dropColumn('nik_hash');
        });
    }
};
