<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokumen;
use App\Models\Transaksi;
use App\Models\LogAktivitas;
use App\Helpers\StatusHelper;
use App\Models\Notifikasi;

class DokumenController extends Controller
{
    /**
     * ======================================
     * UPLOAD BUKTI PEMBAYARAN (USER)
     * ======================================
     */
    
    public function uploadBuktiPembayaran(Request $request)
    {
        $request->validate([
            'id_transaksi' => 'required|exists:transaksi,id_transaksi',
            'bukti_pembayaran' => 'required|image|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        // ambil transaksi
        $transaksi = Transaksi::findOrFail($request->id_transaksi);

        // simpan file
        $file = $request->file('bukti_pembayaran');

        $namaFile = time() . '_' . $file->getClientOriginalName();

        $path = $file->storeAs(
            'dokumen/bukti_pembayaran',
            $namaFile,
            'public'
        );

        // =========================
        // 1. UPDATE TRANSAKSI (LEGACY SYSTEM tetap jalan)
        // =========================
        $transaksi->bukti_transaksi = $namaFile;
        $transaksi->status_transaksi = 'menunggu_verifikasi';
        $transaksi->save();

        // =========================
        // 2. SIMPAN KE DOKUMEN (NEW SYSTEM untuk monitoring)
        // =========================
        
        Dokumen::create([
            'id_user' => auth()->id(),
            'id_transaksi' => $transaksi->id_transaksi,
            'id_pemesanan' => $transaksi->pemesanan->id_pemesanan ?? null,

            'jenis_dokumen' => 'bukti_pembayaran',
            'nama_file' => $namaFile,
            'path_file' => 'dokumen/bukti_pembayaran/'.$namaFile,
            'tipe_file' => $file->getClientMimeType(),
            'ukuran_file' => $file->getSize(),
            'status_verifikasi' => 'pending',
            'sumber_dokumen' => 'pelanggan',
        ]);

        // =========================
        // LOG AKTIVITAS
        // =========================
        LogAktivitas::create([
            'id_user' => auth()->id(),
            'aktivitas' => 'Upload bukti pembayaran transaksi #' . $transaksi->id_transaksi,
            'icon' => 'fa-receipt',
            'tipe' => 'transaksi'
        ]);

        return back()->with('success', 'Bukti pembayaran berhasil dikirim dan menunggu verifikasi admin.');
    }


    /**
     * ======================================
     * ADMIN - TERIMA BUKTI
     * ======================================
     */
    public function approveBukti($id)
{
    $dokumen = Dokumen::findOrFail($id);

    // 1. update dokumen
    $dokumen->update([
        'status_verifikasi' => 'diterima',
        'verified_at' => now()
    ]);

    // 2. ambil transaksi + pemesanan
    $transaksi = Transaksi::with('pemesanan')
        ->find($dokumen->id_transaksi);

    if ($transaksi) {

        // 3. UPDATE STATUS PAKAI SYNC (INI INTI NYA)
        StatusHelper::sync(
            $transaksi,
            'berhasil',
            'Pelunasan Pembayaran'
        );

        // 4. NOTIFIKASI (JANGAN DIHAPUS)
        if ($transaksi->pemesanan) {

            $pemesanan = $transaksi->pemesanan;

            \App\Models\Notifikasi::create([
                'id_user' => $pemesanan->id_user,
                'judul' => 'Transaksi Berhasil Diselesaikan',
                'pesan' => 'Pembayaran telah diverifikasi. Invoice sekarang tersedia.',
                'tipe' => 'pelunasan',
                'status_baca' => 0,
                'status_kirim' => 'terkirim',
                'channel' => 'in_app',
                'referensi_id' => $transaksi->id_transaksi,
                'referensi_tipe' => 'invoice',
            ]);
        }
    }

    // 5. LOG AKTIVITAS (JUGA TETAP)
    LogAktivitas::create([
        'id_user' => auth()->id(),
        'aktivitas' => 'Menerima bukti pembayaran',
        'icon' => 'fa-check-circle',
        'tipe' => 'transaksi'
    ]);

    return back()->with(
        'success',
        'Bukti pembayaran diterima dan transaksi selesai.'
    );
}


    /**
     * ======================================
     * ADMIN - TOLAK BUKTI
     * ======================================
     */
    public function rejectBukti($id)
{
    $dokumen = Dokumen::findOrFail($id);

    // 1. update dokumen
    $dokumen->update([
        'status_verifikasi' => 'ditolak',
        'verified_at' => now()
    ]);

    $transaksi = Transaksi::with('pemesanan')
        ->find($dokumen->id_transaksi);

    if ($transaksi) {

        // 2. sync status (JANGAN MANUAL)
        StatusHelper::sync(
            $transaksi,
            'perlu_upload_ulang', // atau 'menunggu_verifikasi'
            'Upload Ulang Dokumen'
        );

        // 3. NOTIFIKASI (TETAP ADA)
        if ($transaksi->pemesanan) {

            \App\Models\Notifikasi::create([
                'id_user' => $transaksi->pemesanan->id_user,
                'judul' => 'Bukti Pembayaran Ditolak',
                'pesan' => 'Bukti pembayaran Anda ditolak. Silakan upload ulang dengan data yang benar.',
                'tipe' => 'verifikasi',
                'status_baca' => 0,
                'status_kirim' => 'terkirim',
                'channel' => 'in_app',
                'referensi_id' => $transaksi->id_transaksi,
                'referensi_tipe' => 'transaksi',
            ]);
        }
    }

    // 4. LOG AKTIVITAS (TETAP)
    LogAktivitas::create([
        'id_user' => auth()->id(),
        'aktivitas' => 'Menolak bukti pembayaran',
        'icon' => 'fa-times-circle',
        'tipe' => 'transaksi'
    ]);

    return back()->with('success', 'Bukti pembayaran ditolak.');
}
}