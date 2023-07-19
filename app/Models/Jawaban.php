<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    use HasFactory;
    public $table = 'jawabans';
    public $timestamps = true;
    protected $fillable = [
        'dir_jawaban',
        'id_user',
        'id_tugas'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }


    public function tugas()
    {
        return $this->belongsTo(Tugas::class, 'id_tugas', 'id');
    }


    public function nilai()
    {
        return $this->hasOne(Nilai::class, 'id_jawaban', 'id');
    }
}
