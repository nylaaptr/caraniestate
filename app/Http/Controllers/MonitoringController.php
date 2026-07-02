<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Pemesanan;
use App\Models\Notifikasi;
use App\Models\LogAktivitas;
use App\Models\Transaksi;

class MonitoringController extends Controller
{
    // =========================================================
    // HALAMAN MONITORING ADMIN
    // =========================================================
    public function index(Request $request)
    {
        $query = Pemesanan::with([
            'user',
            'properti'
        ]);

        // SEARCH
        if ($request->search) {

            $query->whereHas('user', function ($q) use ($request) {

                $q->where(
                    'nama_user',
                    'like',
                    '%' . $request->search . '%'
                );

            })->orWhereHas('properti', function ($q) use ($request) {

                $q->where(
                    'nama_properti',
                    'like',
                    '%' . $request->search . '%'
                );

            });
        }

        // FILTER STATUS
        if ($request->status) {

            $query->where(
                'status',
                $request->status
            );
        }

        // FILTER METODE
        if ($request->metode) {

            $query->where(
                'metode_pembayaran',
                $request->metode
            );
        }

        // SORTING
        if ($request->sort == 'oldest') {

            $query->oldest();

        } elseif ($request->sort == 'name_asc') {

            $query->join(
                'users',
                'pemesanan.id_user',
                '=',
                'users.id_user'
            )->orderBy(
                'users.nama_user',
                'asc'
            );

        } elseif ($request->sort == 'name_desc') {

            $query->join(
                'users',
                'pemesanan.id_user',
                '=',
                'users.id_user'
            )->orderBy(
                'users.nama_user',
                'desc'
            );

        } else {

            $query->latest();
        }

        $pemesanan = $query
        ->latest()
        ->paginate(6)
        ->withQueryString();

        return view(
            'admin.monitoring-pemesanan',
            compact('pemesanan')
        );
    }

    // =========================================================
    // DETAIL MONITORING ADMIN
    // =========================================================
    public function show($id)
    {
        $pemesanan = Pemesanan::with([
            'user',
            'properti',
            'dokumen'
        ])->findOrFail($id);


        // AMBIL RIWAYAT AKTIVITAS
        $aktivitas = LogAktivitas::where(
            'ref_id',
            $pemesanan->id_pemesanan
        )
        ->latest()
        ->get();

        return view(
            'admin.detail-monitoring',
            compact(
                'pemesanan',
                'aktivitas'
            )
        );
    }

    // =========================================================
    // UPDATE MONITORING
    // =========================================================
    public function update(Request $request, $id)
    {
        $pemesanan = Pemesanan::findOrFail($id);

        /*
        |------------------------------------------------------------------
        | TENTUKAN STATUS TRANSAKSI
        |------------------------------------------------------------------
        */

        $statusTransaksi = 'menunggu_pembayaran';
        if (strtolower($request->status) == 'selesai') {

            $statusTransaksi = 'berhasil';

        }
        elseif (strtolower($request->status) == 'ditolak') {

            $statusTransaksi = 'ditolak';

        }
        elseif (
            strtolower($request->tahap_saat_ini) == 'pelunasan pembayaran'
        ) {

            $statusTransaksi = 'menunggu_pembayaran';
        }
        elseif (
            strtolower($request->tahap_saat_ini) == 'serah terima rumah'
        ) {

            $statusTransaksi = 'berhasil';
        }
        /*
        |------------------------------------------------------------------
        | UPDATE DATA PEMESANAN
        |------------------------------------------------------------------
        */

        $pemesanan->update([

            'tahap_saat_ini' =>
                $request->tahap_saat_ini,

            'status' =>
                $request->status,

            'estimasi_proses' =>
                $request->estimasi_proses,

            'catatan_admin' =>
                $request->catatan_admin,
        ]);
        

        /*
        |------------------------------------------------------------------
        | UPDATE STATUS TRANSAKSI
        |------------------------------------------------------------------
        */

        $transaksi = Transaksi::where(
            'id_user',
            $pemesanan->id_user
        )
        ->where(
            'id_properti',
            $pemesanan->id_properti
        )
        ->orderBy('id_transaksi', 'desc')
        ->first();

        if ($transaksi) {

            $transaksi->update([

                'status_transaksi' => $statusTransaksi
            ]);
        }

        /*
        |------------------------------------------------------------------
        | LOG AKTIVITAS
        |------------------------------------------------------------------
        */

        LogAktivitas::create([

            'id_user' =>
                auth()->user()->id_user,

            'aktivitas' =>
                'Admin mengubah progress menjadi "' .
                $request->tahap_saat_ini .
                '" dengan status "' .
                $request->status .
                '"',

            'icon' =>
                'fa-sync-alt',

            'tipe' =>
                'monitoring',

            'ref_id' =>
                $pemesanan->id_pemesanan
        ]);
    

        /*
        |------------------------------------------------------------------
        | KIRIM NOTIFIKASI
        |------------------------------------------------------------------
        */

        if ($request->kirim_notifikasi) {
            $judul = 'Update Progress Pemesanan';
            $pesan =
                'Pemesanan properti kamu saat ini berada pada tahap "' .
                $request->tahap_saat_ini .
                '" dengan status "' .
                $request->status .
                '".';

            // KHUSUS PELUNASAN
            if (
                strtolower($request->progres) == 'pelunasan' &&
                $request->status != 'Selesai'
            ) {

                $judul = 'Tagihan Pelunasan';
                $pesan = 'Silakan melakukan pelunasan pembayaran rumah Anda. Klik notifikasi ini untuk melihat invoice dan detail tagihan.';

                Notifikasi::create([
                    'id_user' => $pemesanan->id_user,
                    'judul' => $judul,
                    'pesan' => $pesan,
                    'tipe' => 'pelunasan',
                    'status_baca' => 0,
                    'status_kirim' => 'terkirim',
                    'channel' => 'in_app',
                    'referensi_id' => $transaksi->id_transaksi,
                    'referensi_tipe' => 'invoice',
                ]);

            }
            elseif (
                strtolower($request->tahap_saat_ini) == 'pelunasan pembayaran' &&
                $request->status == 'Selesai'
            ) {

                $judul = 'Pelunasan Berhasil';
                $pesan = 'Pembayaran Anda telah berhasil diverifikasi. Klik notifikasi ini untuk melihat invoice.';

                Notifikasi::create([
                    'id_user' => $pemesanan->id_user,
                    'judul' => $judul,
                    'pesan' => $pesan,
                    'tipe' => 'pelunasan',
                    'status_baca' => 0,
                    'status_kirim' => 'terkirim',
                    'channel' => 'in_app',
                    'referensi_id' => $transaksi->id_transaksi,
                    'referensi_tipe' => 'invoice',
                ]);

            } else {

                Notifikasi::create([
                    'id_user' => $pemesanan->id_user,
                    'judul' => $judul,
                    'pesan' => $pesan,
                    'tipe' => 'monitoring',
                    'status_baca' => 0,
                    'status_kirim' => 'terkirim',
                    'channel' => 'in_app',
                    'referensi_id' => $pemesanan->id_pemesanan,
                    'referensi_tipe' => 'pemesanan',
                ]);
            }

            /*
            |--------------------------------------------------------------
            | LOG NOTIFIKASI
            |--------------------------------------------------------------
            */

            LogAktivitas::create([

                'id_user' =>
                    auth()->user()->id_user,

                'aktivitas' =>
                    'Admin mengirim notifikasi monitoring pemesanan',

                'icon' =>
                    'fa-paper-plane',

                'tipe' =>
                    'monitoring',

                'ref_id' =>
                    $pemesanan->id_pemesanan
            ]);
        }
        

        return redirect()
            ->back()
            ->with(
                'success',
                'Monitoring berhasil diperbarui'
            );
    }

    

    // =========================================================
    // HALAMAN MONITORING PELANGGAN
    // =========================================================
    public function pelanggan($id)
{
    // 1. Ambil transaksi dulu (dari klik user)
    // $transaksi = Transaksi::with(['pemesanan','properti'])
    // ->where('id_transaksi', $id)
    // ->where('id_user', auth()->id())
    // ->firstOrFail();
    $pemesanan = Pemesanan::where('id_pemesanan', $id)
    ->where('id_user', auth()->id())
    ->firstOrFail();

    // 2. Ambil pemesanan dari transaksi
    $transaksi = $pemesanan->transaksi;

    // 3. Ambil aktivitas dari PEMESANAN (bukan transaksi)
    $aktivitas = LogAktivitas::where(
        'ref_id',
        $pemesanan->id_pemesanan
    )
    ->latest()
    ->get();

    return view('detail-pemesanan', compact('pemesanan', 'aktivitas', 'transaksi'));
}
}