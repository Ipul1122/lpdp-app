<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UniversitasPendaftaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'negara_tujuan', 'provinsi', 'kota', 
        'nama_universitas', 'program_studi', 'tanggal_mulai_studi', 
        'durasi_studi', 'loa', 'khs_ipk'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}