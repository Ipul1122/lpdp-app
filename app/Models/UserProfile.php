<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'foto_ktp', 'nik', 'nama', 'no_telp', 'tempat_tglLahir', 
        'alamat', 'rt', 'rw', 'kelurahan', 'kecamatan', 
        'agama', 'status_perkawinan', 'pekerjaan', 'kewarganegaraan',
        'program_beasiswa', 'status', 'catatan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}