<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tahun extends Model
{
    use HasFactory;
    protected $table = 'tahun';
    protected $guarded = ['id'];


    public function siswa()
    {
        return $this->hasOne(siswa::class);
    }
}
