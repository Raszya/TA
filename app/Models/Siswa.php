<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Siswa extends Model
{
    use HasFactory;
    public $table = 'siswas';
    public $timestamps = true;
    protected $fillable = [
        'nis',
        'nama',
        'alamat',
        'jk',
        'notelp',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
