<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiodataPendaftaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'deskripsi_diri', 'riwayat_pendidikan', 'pengalaman_kerja', 
        'pengalaman_organisasi', 'prestasi', 'keahlian', 'bahasa'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}