<?php

namespace App\Models;

use App\Models\Bab;
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
        return $this->hasMany(Bab::class);
    }
}
