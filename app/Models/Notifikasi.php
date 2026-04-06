<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    protected $table = 'notifikasi'; // ← tambahkan ini
    protected $primaryKey = 'id_notifikasi';
    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'judul',
        'pesan',
        'tipe',
        'status_baca',
        'status_kirim',
        'channel',
        'referensi_id',
        'referensi_tipe',
        'created_at',
    ];
}