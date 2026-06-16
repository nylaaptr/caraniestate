<?php

namespace App\Helpers;

class StatusHelper
{
    public static function sync($transaksi, $statusTransaksi, $tahap)
    {
        // UPDATE TRANSAKSI
        $transaksi->update([
            'status_transaksi' => $statusTransaksi,
        ]);

        // UPDATE PEMESANAN
        if ($transaksi->pemesanan) {

            $statusPemesanan = 'Proses';

            if (
                $statusTransaksi == 'berhasil' ||
                $statusTransaksi == 'selesai'
            ) {
                $statusPemesanan = 'Selesai';
            }

            elseif ($statusTransaksi == 'ditolak') {
                $statusPemesanan = 'Ditolak';
            }

            $transaksi->pemesanan->update([
                'status' => $statusPemesanan,
                'tahap_saat_ini' => $tahap,
            ]);
        }
    }
}