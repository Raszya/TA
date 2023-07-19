<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guru extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $table = 'gurus';
    public $timestamps = true;
    protected $fillable = [
        'nomer_induk',
        'nama',
        'alamat',
        'jk',
        'notelp',
        'is_aktif'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function Trx_mapel_guru()
    {
        return $this->belongsTo(Trx_mapel_guru::class);
    }
}