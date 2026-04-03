<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Perumahan extends Model
{
    protected $table = 'perumahan';
    protected $primaryKey = 'id_perumahan';
    public $timestamps = false;

    protected $fillable = ['nama_perumahan'];
}