<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kpr extends Model
{
    protected $table = 'kpr';
    protected $primaryKey = 'id_kpr';
    public $timestamps = false;

    protected $fillable = [
        'id_transaksi',
        'nama_bank',
        'nomor_kontrak',
        'harga_properti',
        'uang_muka',
        'jumlah_pinjaman',
        'suku_bunga',
        'tenor',
        'angsuran_perbulan',
        'status_kpr',
        'catatan',
    ];
}