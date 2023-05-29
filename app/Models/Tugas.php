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
        'dir_tugas',
        'deadline',
    ];
}
