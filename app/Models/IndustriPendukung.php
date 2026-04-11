<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndustriPendukung extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'instansi', 'sektor', 'jenis_instansi', 'nama_instansi', 
        'telepon_instansi', 'provinsi', 'kab_kota', 'alamat_instansi', 
        'status_kepegawaian', 'tanggal_mulai_kerja', 'pekerjaan', 
        'penghasilan', 'deskripsi_pekerjaan', 'surat_izin'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}