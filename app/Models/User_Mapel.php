<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Psy\CodeCleaner\FunctionContextPass;

class User_Mapel extends Model
{
    use HasFactory;
    protected $table = 'trx_mapel';
    protected $guarded = ['id'];

    public function mapels()
    {
        return $this->belongsTo(Mapel::class, 'id_mapel', 'id_mapel');
    }
}
