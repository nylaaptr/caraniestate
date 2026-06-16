<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GambarProperti extends Model
{
    protected $table = 'gambar_properti';

    protected $primaryKey = 'id_gambar';

    protected $fillable = [
        'id_properti',
        'path_gambar'
    ];

    public function properti()
    {
        return $this->belongsTo(Properti::class, 'id_properti', 'id_properti');
    }
}