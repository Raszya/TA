<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bab extends Model
{
    use HasFactory;
    public $table = 'babs';
    public $timestamps = true;
    protected $fillable = [
        'id_mapel',
        'nama',
        'desc',
    ];
}
