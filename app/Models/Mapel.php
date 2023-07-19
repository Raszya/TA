<?php

namespace App\Models;

use App\Models\Bab;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mapel extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $table = 'mapels';
    public $timestamps = true;
    protected $primaryKey = 'id_mapel';
    protected $dates = ['deleted_at'];
    protected $fillable = ['id_mapel', 'nama', 'is_aktif'];

    public function getIsAktifAttribute()
    {
        return $this->attributes['is_aktif'] == 1;
    }

    public function bab()
    {
        return $this->hasMany(Bab::class, 'id_mapel', 'id_mapel');
    }

    public function users()
    {
        return $this->belongsTo(User::class);
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

    public function Trx_mapel_guru()
    {
        return $this->hasMany(Trx_mapel_guru::class);
    }
}
