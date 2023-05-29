<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modul extends Model
{
    use HasFactory;
    public $table = 'moduls';
    public $timestamps = true;
    protected $fillable = [
        'id_bab',
        'dir_modul',
    ];
}
