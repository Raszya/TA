<?php

namespace App\Models;

use App\Models\User;
use App\Models\Jurusan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Siswa extends Model
{
    use HasFactory;
    public $table = 'siswas';
    public $timestamps = true;
    protected $fillable = [
        'nis',
        'id_jurusan',
        'nama',
        'alamat',
        'jk',
        'notelp',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan', 'id');
    }
}
