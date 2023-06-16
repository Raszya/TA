<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;
    protected $table = 'nilais';
    protected $guarded = ['id'];


    public function jawaban()
    {
        return $this->belongsTo(Jawaban::class, 'id_jawaban', 'id');
    }
}
