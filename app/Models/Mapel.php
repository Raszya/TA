<?php

namespace App\Models;

use App\Models\Bab;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mapel extends Model
{
    use HasFactory;
    public $table = 'mapels';
    public $timestamps = true;
    protected $fillable = [
        'nama',
        'kode_akses',
        'id_user',
        'desc',
        'status',
    ];

    public function bab()
    {
        return $this->hasMany(Bab::class, 'id_mapel', 'id_mapel');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function user_mapel()
    {
        return $this->hasMany(User_Mapel::class, 'id_user', 'id');
    }

    public function jawaban()
    {
        return $this->hasMany(Jawaban::class);
    }
}
