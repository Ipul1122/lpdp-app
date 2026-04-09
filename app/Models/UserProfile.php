<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $fillable = [
        'user_id', 'foto_ktp', 'nik', 'nama', 'tempat_tglLahir', 
        'alamat', 'rt', 'rw', 'kelurahan', 'kecamatan', 
        'agama', 'status_perkawinan', 'pekerjaan', 'kewarganegaraan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }
}