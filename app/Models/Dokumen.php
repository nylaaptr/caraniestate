<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    protected $table = 'dokumen';

    protected $primaryKey = 'id_dokumen';

    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'id_pemesanan',
        'id_transaksi',
        'jenis_dokumen',
        'nama_file',
        'path_file',
        'tipe_file',
        'ukuran_file',
        'status_verifikasi',
        'catatan_verifikasi',
        'sumber_dokumen',
    ];

    // ✅ Relasi ke Transaksi
    public function transaksi()
    {
        return $this->belongsTo(\App\Models\Transaksi::class, 'id_transaksi', 'id_transaksi');
    }

    // ✅ Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class, 'id_pemesanan');
    }
}