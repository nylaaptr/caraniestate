<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Blok;

class Perumahan extends Model
{
    protected $table = 'perumahan';
    protected $primaryKey = 'id_perumahan';

    public $timestamps = false;

    // AMAN: pakai guarded supaya tidak mass assignment error lagi
    protected $guarded = [];

    public function blok()
    {
        return $this->hasMany(Blok::class, 'id_perumahan', 'id_perumahan');
    }
}