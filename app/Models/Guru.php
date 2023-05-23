<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;
    public $table = 'gurus';
    public $timestamps = true;
    protected $fillable = [
        'nomer_induk',
        'nama',
        'alamat',
        'jk',
        'notelp',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
