<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Trxjawaban extends Model
{
    use HasFactory;
    public $table = 'trx_jawaban';
    public $timestamps = true;
    protected $fillable = [
        'id_user',
        'id_tugas',
        'id_jawaban',
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function tugas()
    {
        return $this->belongsTo(Tugas::class);
    }

    public function jawaban()
    {
        return $this->belongsTo(Jawaban::class);
    }
}
