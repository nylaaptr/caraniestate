<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LogAktivitas;
use App\Models\Transaksi;
use App\Models\PembayaranLunas;
use Barryvdh\DomPDF\Facade\Pdf;

class TransaksiController extends Controller
{
    // =========================
    // PEMBAYARAN LUNAS (VIEW)
    // =========================
    public function invoice($id)
    {
        $transaksi = Transaksi::with([
            'properti.blok',
            'user'
        ])->findOrFail($id);

        LogAktivitas::create([
            'id_user' => auth()->id(),
            'aktivitas' =>
                'Membuka invoice transaksi #' .
                $transaksi->id_transaksi,
            'icon' => 'fa-file-invoice',
            'tipe' => 'transaksi'
        ]);

        return view(
            'invoice',
            compact('transaksi')
        );
    }

    // =========================
// DOWNLOAD PDF INVOICE
// =========================
public function downloadPdf($id)
{
    $transaksi = Transaksi::with([
        'properti.gambar',
        'properti.blok',
        'properti.perumahan',
        'user'
    ])->findOrFail($id);

    $pdf = Pdf::loadView(
        'pdf.invoice',
        compact('transaksi')
    );

    return $pdf->download(
        'Invoice-'.$transaksi->id_transaksi.'.pdf'
    );
}


    // =========================
    // SIMPAN PEMBAYARAN LUNAS
    // =========================
    public function storePembayaranLunas(Request $request)
{
    $request->validate([
        'id_transaksi'      => 'required',
        'tanggal_transfer'  => 'required',
        // 'bank_pengirim'     => 'required',
        'bukti_pembayaran'  =>
            'required|mimes:jpg,jpeg,png,pdf|max:5120'
    ]);

    $file = $request->file('bukti_pembayaran');

    $namaFile =
        time() . '_' .
        $file->getClientOriginalName();

    $file->move(
        public_path('uploads/pembayaran-lunas'),
        $namaFile
    );

    $transaksi =
        Transaksi::findOrFail(
            $request->id_transaksi
        );

    $transaksi->bukti_transaksi =
        $namaFile;

    $transaksi->metode_pembayaran =
        'transfer_bank';

    $transaksi->status_transaksi =
        'menunggu_verifikasi';

    $transaksi->save();
    dd($transaksi->fresh()->bukti_transaksi);

    LogAktivitas::create([
        'id_user' => auth()->id(),
        'aktivitas' =>
            'Mengupload bukti pembayaran lunas untuk transaksi #'
            . $transaksi->id_transaksi,
        'icon' => 'fa-file-invoice-dollar',
        'tipe' => 'transaksi'
    ]);

    return redirect()
        ->route(
            'invoice',
            $transaksi->id_transaksi
        )
        ->with(
            'success',
            'Bukti pembayaran berhasil dikirim dan sedang menunggu verifikasi admin.'
        );
}


}