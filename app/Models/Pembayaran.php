<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';
    protected $primaryKey = 'id_pembayaran';
    public $timestamps = false;

    protected $fillable = [
        'id_transaksi', 'jumlah_bayar', 'tanggal_bayar',
        'ke_pembayaran', 'status_bayar', 'bukti_transfer',
    ];
}