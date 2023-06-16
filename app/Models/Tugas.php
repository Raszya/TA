<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    use HasFactory;
    public $table = 'tugass';
    public $timestamps = true;
    protected $fillable = [
        'id_bab',
        'desc',
        'dir_tugas',
        'deadline',
    ];

    public function jawaban()
    {
        return $this->hasMany(Jawaban::class, 'id_tugas', 'id');
    }

    public function bab()
    {
        return $this->belongsTo(Bab::class, 'id_bab', 'id');
    }

    public function trxjawaban()
    {
        return $this->hasMany(Trxjawaban::class, 'id_tugas', 'id');
    }
}
