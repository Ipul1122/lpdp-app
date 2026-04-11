<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekomendasiPendaftaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'nama_perekomendasi', 'instansi_perekomendasi', 
        'jabatan_perekomendasi', 'file_rekomendasi'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}