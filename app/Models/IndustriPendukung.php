<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndustriPendukung extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'unit_kerja', 'jabatan', 'golongan', 'nama_instansi', 
        'tanggal_mulai_kerja', 'tanggal_pensiun', 'surat_izin'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}