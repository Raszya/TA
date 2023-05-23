<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
