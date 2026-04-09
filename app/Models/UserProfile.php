<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $fillable = [
        'user_id', 'foto_ktp', 'nik', 'nama', 'no_telp','tempat_tglLahir', 
        'alamat', 'rt', 'rw', 'kelurahan', 'kecamatan', 
        'agama', 'status_perkawinan', 'pekerjaan', 'kewarganegaraan',
        
        // Tambahkan 2 field baru ini
        'program_beasiswa',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}