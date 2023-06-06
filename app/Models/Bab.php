<?php

namespace App\Models;

use App\Models\Mapel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'id_mapel', 'id');
    }
}
