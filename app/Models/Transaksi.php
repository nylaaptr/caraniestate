<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Kpr;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'id_properti',
        'tanggal_transaksi',
        'total_harga',
        'jenis_pembayaran',
        'status_transaksi',
    ];

    // Relasi ke properti
    public function properti()
    {
        return $this->belongsTo(Properti::class, 'id_properti', 'id_properti');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'id_transaksi', 'id_transaksi');
    }

    public function kpr()
    {
        return $this->hasOne(Kpr::class, 'id_transaksi', 'id_transaksi');
    }
}