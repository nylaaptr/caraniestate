<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Kpr;
use App\Models\Dokumen; // ✅ Tambah import ini

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
        'jenis_transaksi',
        'metode_pembayaran',
        'status_transaksi',
        'bukti_transaksi'
    ];

    // Relasi ke properti
    public function properti()
    {
        return $this->belongsTo(Properti::class, 'id_properti', 'id_properti');
    }

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    // Relasi ke pembayaran
    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'id_transaksi', 'id_transaksi');
    }

    // Relasi ke KPR
    public function kpr()
    {
        return $this->hasOne(Kpr::class, 'id_transaksi', 'id_transaksi');
    }

    // ✅ TAMBAHKAN INI: Relasi ke Dokumen
    public function dokumen()
    {
        return $this->hasMany(
            Dokumen::class,
            'id_transaksi',
            'id_transaksi'
        );
    }

    // RELASI KE PEMESANAN
    public function pemesanan()
    {
        return $this->hasOne(
            Pemesanan::class,
            'id_transaksi',
            'id_transaksi'
        );
    }

    
}