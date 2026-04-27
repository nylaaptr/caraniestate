<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Properti;
use App\Models\Notifikasi;
use App\Models\Dokumen;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PemesananController extends Controller
{
    public function proses(Request $request)
    {
        $request->validate([
            'id_properti'    => 'required|exists:properti,id_properti',
            'jenis_transaksi'=> 'required|in:lunas,kredit,kpr,cash,installment,other',
        ]);

        $properti = Properti::find($request->id_properti);

        // Simpan Transaksi
        $transaksi = Transaksi::create([
            'id_user'          => Auth::user()->id_user,
            'id_properti'      => $request->id_properti,
            'tanggal_transaksi'=> now()->toDateString(),
            'total_harga'      => $properti->harga_properti,
            'jenis_transaksi'  => $request->jenis_transaksi,
            'status_transaksi' => 'menunggu_verifikasi',
        ]);

        // Daftar dokumen yang perlu disimpan
        // key = nama input di form, value = enum jenis_dokumen di DB
        $dokumenList = [
            'ktp'                   => 'ktp',
            'kk'                    => 'kk',
            'surat_nikah'           => 'surat_nikah',
            'npwp'                  => 'npwp',
            'slip_gaji'             => 'slip_gaji',
            'rekening_koran'        => 'rekening_koran',
            'foto_3x4'              => 'foto_3x4',
            'surat_kerja'           => 'surat_kerja',
            'selfie'                => 'selfie',
            'foto_tempat_kerja'     => 'foto_tempat_kerja',
            // Wiraswasta
            'ktpw'                  => 'ktp',
            'kkW'                   => 'kk',
            'surat_nikahW'          => 'surat_nikah',
            'npwp_W'                => 'npwp',
            'spt'                   => 'spt',
            'surat_ket_usaha'       => 'surat_ket_usaha',
            'surat_penghasilan_usaha'=> 'surat_penghasilan_usaha',
            'pembukuan_usaha'       => 'pembukuan_usaha',
            'rekening_koranW'       => 'rekening_koran',
            'selfieW'               => 'selfie',
            'foto_tempat_usaha'     => 'foto_tempat_usaha',
        ];

        foreach ($dokumenList as $inputName => $jenisDokumen) {
            if ($request->hasFile($inputName)) {
                $files = is_array($request->file($inputName)) 
                    ? $request->file($inputName) 
                    : [$request->file($inputName)];

                foreach ($files as $file) {
                    $namaFile = time() . '_' . $file->getClientOriginalName();
                    $path = $file->storeAs('dokumen/' . Auth::user()->id_user, $namaFile, 'public');

                    Dokumen::create([
                        'id_user'          => Auth::user()->id_user,
                        'jenis_dokumen'    => $jenisDokumen,
                        'nama_file'        => $namaFile,
                        'path_file'        => $path,
                        'tipe_file'        => $file->getClientMimeType(),
                        'ukuran_file'      => $file->getSize(),
                        'status_verifikasi'=> 'pending',
                        'catatan_verifikasi'=> '',
                    ]);
                }
            }
        }

        // Notifikasi ke User
        Notifikasi::create([
            'id_user'        => Auth::user()->id_user,
            'judul'          => 'Pemesanan Berhasil Dikirim',
            'pesan'          => 'Pemesanan kamu untuk ' . $properti->nama_properti . ' sedang menunggu verifikasi admin.',
            'tipe'           => 'transaksi',
            'status_baca'    => 0,
            'status_kirim'   => 'terkirim',
            'channel'        => 'in_app',
            'referensi_id'   => $transaksi->id_transaksi,
            'referensi_tipe' => 'transaksi',
        ]);

        // Notifikasi ke semua Admin
        $admins = User::where('role_user', 'admin')->get();
        foreach ($admins as $admin) {
            Notifikasi::create([
                'id_user'        => $admin->id_user,
                'judul'          => 'Pemesanan Baru Masuk',
                'pesan'          => Auth::user()->nama_user . ' memesan ' . $properti->nama_properti . '.',
                'tipe'           => 'transaksi',
                'status_baca'    => 0,
                'status_kirim'   => 'terkirim',
                'channel'        => 'in_app',
                'referensi_id'   => $transaksi->id_transaksi,
                'referensi_tipe' => 'transaksi',
            ]);
        }

        return redirect()->route('pemesanan.terima-kasih', ['id' => $transaksi->id_transaksi]);
    }

    $request->validate([
    'jenis_transaksi' => 'required',
    'bukti_booking' => $request->jenis_transaksi == 'lunas' 
        ? 'required|file|mimes:jpg,jpeg,png,pdf|max:5120'
        : 'nullable'
]);
}