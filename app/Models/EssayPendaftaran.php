<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EssayPendaftaran extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'essay_kontribusi'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}