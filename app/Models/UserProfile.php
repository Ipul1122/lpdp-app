<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\IndustriPendukung;
use App\Models\UniversitasPendaftaran;
use App\Models\BiodataPendaftaran;
use App\Models\RekomendasiPendaftaran;
use App\Models\EssayPendaftaran;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'foto_ktp', 'nik', 'nama', 'no_telp', 'tempat_tglLahir', 
        'alamat', 'rt', 'rw', 'kelurahan', 'kecamatan', 
        'agama', 'status_perkawinan', 'pekerjaan', 'kewarganegaraan',
        'program_beasiswa', 'status', 'catatan', 'is_pengajuan_ulang',
        'submitted_at', 'responded_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'submitted_at' => 'datetime',
        'responded_at' => 'datetime',
    ];

    // Relasi untuk menarik data lain berdasarkan user_id yang sama
    public function industri() { 
        return $this->hasOne(IndustriPendukung::class, 'user_id', 'user_id'); }
    public function universitas() { 
        return $this->hasOne(UniversitasPendaftaran::class, 'user_id', 'user_id'); }
    public function biodata() {
        return $this->hasOne(BiodataPendaftaran::class, 'user_id', 'user_id'); }
    public function rekomendasi() { 
        return $this->hasOne(RekomendasiPendaftaran::class, 'user_id', 'user_id'); }
    public function essay() { 
        return $this->hasOne(EssayPendaftaran::class, 'user_id', 'user_id'); }
}