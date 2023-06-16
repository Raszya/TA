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

    // public function mapel()
    // {
    //     return $this->belongsTo(Mapel::class, 'id_mapel', 'id_mapel');
    // }    

    public function tugas()
    {
        return $this->belongsTo(Tugas::class, 'id_tugas', 'id');
    }

    public function trxjawaban()
    {
        return $this->hasMany(Trxjawaban::class, 'id_jawaban', 'id');
    }

    public function nilai()
    {
        return $this->hasOne(Nilai::class, 'id_jawaban', 'id');
    }
}
