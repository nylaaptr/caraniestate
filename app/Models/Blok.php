<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blok extends Model
{
    protected $table = 'blok';
    protected $primaryKey = 'id_blok';
    public $timestamps = false;

    protected $fillable = [
        'id_perumahan',
        'nama_blok'
    ];


    public function perumahan()
{
    return $this->belongsTo(
        \App\Models\Perumahan::class,
        'id_perumahan',
        'id_perumahan'
    );
}
}

