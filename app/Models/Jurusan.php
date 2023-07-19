<?php

namespace App\Models;

use App\Models\Siswa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jurusan extends Model
{
    use HasFactory;
    public $table = 'jurusans';
    public $timestamps = true;
    protected $fillable = [
        'nama',
    ];

    public function siswa()
    {
        return $this->hasOne(Siswa::class);
    }
}
