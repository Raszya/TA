<?php

namespace App\Models;

use App\Models\User;
use App\Models\Jurusan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Siswa extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $table = 'siswas';
    public $timestamps = true;
    protected $fillable = [
        'nis',
        'id_jurusan',
        'id_kelas',
        'id_tahun',
        'nama',
        'alamat',
        'jk',
        'notelp',
        'is_aktif',
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan', 'id');
    }
    public function kelas()
    {
        return $this->belongsTo(kelas::class, 'id_kelas', 'id');
    }
    public function tahun()
    {
        return $this->belongsTo(tahun::class, 'id_tahun', 'id');
    }
}
