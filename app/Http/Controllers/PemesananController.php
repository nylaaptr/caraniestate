<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use App\Models\Transaksi;
use App\Models\Properti;
use App\Models\Notifikasi;
use App\Models\Dokumen;
use App\Models\User;
use App\Models\Pemesanan;
use App\Models\LogAktivitas;

use App\Mail\NotifikasiEmail;

class PemesananController extends Controller
{
    public function proses(Request $request)
    {
        // ======================================
        // VALIDASI
        // ======================================

        $request->validate([
            'id_properti' => 'required|exists:properti,id_properti',

            'jenis_transaksi' => 'required|in:lunas,kredit',

            'bukti_booking' => $request->jenis_transaksi == 'lunas'
                ? 'required|file|mimes:jpg,jpeg,png,pdf|max:5120'
                : 'nullable'
        ]);

        // ======================================
        // AMBIL DATA
        // ======================================

        $user = Auth::user();

        $properti = Properti::findOrFail($request->id_properti);

        // ======================================
        // SIMPAN TRANSAKSI
        // ======================================

        $transaksi = Transaksi::create([
            'id_user' => $user->id_user,

            'id_properti' => $request->id_properti,

            'tanggal_transaksi' => now()->toDateString(),

            'total_harga' => $properti->harga_properti,

            'jenis_transaksi' => $request->jenis_transaksi,

            'status_transaksi' => 'menunggu_verifikasi',
        ]);

        // ======================================
        // SIMPAN PEMESANAN
        // ======================================

        $pemesanan = Pemesanan::create([

            'kode_pemesanan' => 'PSN-' . time(),
            'id_transaksi' => $transaksi->id_transaksi,
            'id_user' => $user->id_user,
            'id_properti' => $request->id_properti,
            'total_harga' => $properti->harga_properti,
            'metode_pembayaran' => $request->jenis_transaksi,
            'tahap_saat_ini' => 'Pemesanan Dibuat',
            'status' => 'Proses',
            'tanggal_pemesanan' => now(),
        ]);

        // ======================================
        // LOG AKTIVITAS
        // ======================================

        LogAktivitas::create([
            'id_user' => $user->id_user,

            'aktivitas' => 'Melakukan pemesanan properti ' . $properti->nama_properti,

            'icon' => 'fa-cart-shopping',

            'tipe' => 'transaksi'
        ]);

        // ======================================
        // LIST DOKUMEN
        // ======================================

        $dokumenList = [

            'ktp' => 'ktp',
            'kk' => 'kk',
            'surat_nikah' => 'surat_nikah',
            'npwp' => 'npwp',
            'slip_gaji' => 'slip_gaji',
            'rekening_koran' => 'rekening_koran',
            'foto_3x4' => 'foto_3x4',
            'surat_kerja' => 'surat_kerja',
            'selfie' => 'selfie',
            'foto_tempat_kerja' => 'foto_tempat_kerja',

            // Wiraswasta
            'spt_pajak' => 'spt_pajak',
            'surat_keterangan_usaha' => 'surat_keterangan_usaha',
            'surat_penghasilan_usaha' => 'surat_penghasilan_usaha',
            'pembukuan_usaha' => 'pembukuan_usaha',
            'foto_lokasi_usaha' => 'foto_lokasi_usaha',
        ];

        // ======================================
        // SIMPAN DOKUMEN
        // ======================================

        foreach ($dokumenList as $inputName => $jenisDokumen) {

            if ($request->hasFile($inputName)) {

                $files = is_array($request->file($inputName))
                    ? $request->file($inputName)
                    : [$request->file($inputName)];

                foreach ($files as $file) {

                    $namaFile =
                        time() . '_' .
                        $inputName . '_' .
                        $file->getClientOriginalName();

                    $path = $file->storeAs(
                        'dokumen/' . $user->id_user,
                        $namaFile,
                        'public'
                    );

                    Dokumen::create([

                        'id_user' => $user->id_user,

                        'id_pemesanan' => $pemesanan->id_pemesanan,

                        'id_transaksi' => $transaksi->id_transaksi,

                        'jenis_dokumen' => $jenisDokumen,

                        'nama_file' => $namaFile,

                        'path_file' => $path,

                        'tipe_file' => $file->getClientMimeType(),

                        'ukuran_file' => $file->getSize(),

                        'status_verifikasi' => 'pending',

                        'catatan_verifikasi' => '',
                    ]);
                }
            }
        }

        // ======================================
        // SIMPAN BUKTI BOOKING
        // ======================================

        if ($request->hasFile('bukti_booking')) {

            $file = $request->file('bukti_booking');

            $namaFile =
                time() . '_booking_' .
                $file->getClientOriginalName();

            $path = $file->storeAs(
                'dokumen/' . $user->id_user,
                $namaFile,
                'public'
            );

            Dokumen::create([

                'id_user' => $user->id_user,

                'id_pemesanan' => $pemesanan->id_pemesanan,

                'id_transaksi' => $transaksi->id_transaksi,

                'jenis_dokumen' => 'bukti_booking',

                'nama_file' => $namaFile,

                'path_file' => $path,

                'tipe_file' => $file->getClientMimeType(),

                'ukuran_file' => $file->getSize(),

                'status_verifikasi' => 'pending',

                'catatan_verifikasi' => '',
            ]);

            // ======================================
            // LOG AKTIVITAS DOKUMEN
            // ======================================

            LogAktivitas::create([
                'id_user' => $user->id_user,

                'aktivitas' => 'Mengupload bukti booking',

                'icon' => 'fa-file-upload',

                'tipe' => 'dokumen'
            ]);
        }

        // ======================================
        // NOTIFIKASI CUSTOMER
        // ======================================

        Notifikasi::create([

            'id_user' => $user->id_user,

            'judul' => 'Pemesanan Berhasil Dikirim',

            'pesan' =>
                'Pemesanan kamu untuk ' .
                $properti->nama_properti .
                ' sedang menunggu verifikasi admin.',

            'tipe' => 'transaksi',

            'status_baca' => 0,

            'status_kirim' => 'terkirim',

            'channel' => 'in_app',

            'referensi_id' => $transaksi->id_transaksi,

            'referensi_tipe' => 'transaksi',
        ]);

        // ======================================
        // EMAIL CUSTOMER
        // ======================================

        if ($user->email_user) {

            Mail::to($user->email_user)->send(

                new NotifikasiEmail([

                    'judul' => 'Pemesanan Berhasil',

                    'pesan' =>
                        'Pemesanan properti ' .
                        $properti->nama_properti .
                        ' berhasil dikirim dan menunggu verifikasi admin.'
                ])
            );
        }

        // ======================================
        // NOTIFIKASI ADMIN
        // ======================================

        $admins = User::where('role_user', 'admin')->get();

        foreach ($admins as $admin) {

            Notifikasi::create([

                'id_user' => $admin->id_user,

                'judul' => 'Pemesanan Baru Masuk',

                'pesan' =>
                    $user->nama_user .
                    ' memesan ' .
                    $properti->nama_properti . '.',

                'tipe' => 'transaksi',

                'status_baca' => 0,

                'status_kirim' => 'terkirim',

                'channel' => 'in_app',

                'referensi_id' => $transaksi->id_transaksi,

                'referensi_tipe' => 'transaksi',
            ]);

            // EMAIL ADMIN

            if ($admin->email_user) {

                Mail::to($admin->email_user)->send(

                    new NotifikasiEmail([

                        'judul' => 'Pemesanan Baru',

                        'pesan' =>
                            $user->nama_user .
                            ' melakukan pemesanan properti ' .
                            $properti->nama_properti
                    ])
                );
            }
        }

        // ======================================
        // REDIRECT
        // ======================================

        return redirect()->route(
            'pemesanan.terima-kasih',
            [
                'id' => $transaksi->id_transaksi
            ]
        );
    }
}