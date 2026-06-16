<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    protected $table = 'pemesanan';
    protected $primaryKey = 'id_pemesanan';
    protected $fillable = [
        'kode_pemesanan',
        'id_transaksi',
        'id_user',
        'id_properti',
        'total_harga',
        'metode_pembayaran',
        'tahap_saat_ini',
        'status',
        'tanggal_pemesanan',
        'estimasi_proses',
        'catatan_admin',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function properti()
    {
        return $this->belongsTo(Properti::class, 'id_properti');
    }

    public function dokumen()
    {
        return $this->hasMany(
            Dokumen::class,
            'id_pemesanan',
            'id_pemesanan'
        );
    }

    public function transaksi()
    {
        return $this->belongsTo(
            Transaksi::class,
            'id_transaksi',
            'id_transaksi'
        );
    }
}