<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class LaporanPenjualanController extends Controller
{
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | QUERY DASAR
        |--------------------------------------------------------------------------
        */

        $query = Transaksi::with([
            'user',
            'properti'
        ]);


        /*
        |--------------------------------------------------------------------------
        | FILTER TANGGAL
        |--------------------------------------------------------------------------
        */

        $dateStart = $request->date_start;
        $dateEnd = $request->date_end;

        if ($dateStart && $dateEnd) {

            $query->whereBetween('tanggal_transaksi', [
                $dateStart . ' 00:00:00',
                $dateEnd . ' 23:59:59'
            ]);

        }



        /*
        |--------------------------------------------------------------------------
        | FILTER STATUS
        |--------------------------------------------------------------------------
        */

        if (
            $request->filled('status_transaksi') &&
            $request->status_transaksi != 'all'
        ) {

            $query->where(
                'status_transaksi',
                $request->status_transaksi
            );
        }


        /*
        |--------------------------------------------------------------------------
        | FILTER TIPE PROPERTI
        |--------------------------------------------------------------------------
        */

        if (
            $request->filled('type') &&
            $request->type != 'all'
        ) {

            $query->whereHas('properti', function ($q) use ($request) {

                $q->where(
                    'tipe_properti',
                    $request->type
                );

            });
        }


        /*
        |--------------------------------------------------------------------------
        | SEARCH
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where(
                    'id_transaksi',
                    'like',
                    "%{$search}%"
                )

                ->orWhereHas('user', function ($user) use ($search) {

                    $user->where(
                        'nama_user',
                        'like',
                        "%{$search}%"
                    );

                })

                ->orWhereHas('properti', function ($properti) use ($search) {

                    $properti->where(
                        'nama_properti',
                        'like',
                        "%{$search}%"
                    );

                });

            });
        }


        /*
        |--------------------------------------------------------------------------
        | DATA TRANSAKSI
        |--------------------------------------------------------------------------
        */
        
        $transaksi = $query
            ->orderBy('tanggal_transaksi', 'desc')
            ->paginate(10);


        /*
        |--------------------------------------------------------------------------
        | CLONE QUERY
        |--------------------------------------------------------------------------
        */

        $summaryQuery = clone $query;


        /*
        |--------------------------------------------------------------------------
        | TOTAL PENDAPATAN
        |--------------------------------------------------------------------------
        */

        $pendapatanBulanIni = (clone $summaryQuery)
            ->where('status_transaksi', 'berhasil')
            ->sum('total_harga');


        /*
        |--------------------------------------------------------------------------
        | TOTAL TRANSAKSI
        |--------------------------------------------------------------------------
        */

        $totalTransaksi = (clone $summaryQuery)
            ->count();


        /*
        |--------------------------------------------------------------------------
        | TOTAL PENDING
        |--------------------------------------------------------------------------
        */

        $totalPending = (clone $summaryQuery)

            ->whereIn('status_transaksi', [

                'menunggu_verifikasi',
                'menunggu_pembayaran',
                'perlu_upload_ulang'

            ])

            ->count();


        /*
        |--------------------------------------------------------------------------
        | TOTAL DITOLAK
        |--------------------------------------------------------------------------
        */

        $totalBatal = (clone $summaryQuery)

            ->where('status_transaksi', 'ditolak')

            ->count();


        /*
        |--------------------------------------------------------------------------
        | PERSENTASE DUMMY
        |--------------------------------------------------------------------------
        */

        $persenPendapatan = 12.5;
        $persenTransaksi = 8.3;
        $persenPending = -3.1;
        $persenBatal = 1.2;


        /*
        |--------------------------------------------------------------------------
        | CHART BULANAN
        |--------------------------------------------------------------------------
        */

        $labelBulanan = [
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'Mei',
            'Jun',
            'Jul',
            'Agu',
            'Sep',
            'Okt',
            'Nov',
            'Des'
        ];

        $dataTransaksi = [];
        $dataPendapatan = [];

        for ($bulan = 1; $bulan <= 12; $bulan++) {

            // Total transaksi
            $totalTransaksiBulanan = Transaksi::whereMonth('tanggal_transaksi', $bulan)
                ->whereYear('tanggal_transaksi', date('Y'))
                ->count();

            // Total pendapatan
            $totalPendapatanBulanan = Transaksi::whereMonth('tanggal_transaksi', $bulan)
                ->whereYear('tanggal_transaksi', date('Y'))
                ->where('status_transaksi', 'berhasil')
                ->sum('total_harga');

            $dataTransaksi[] = $totalTransaksiBulanan;
            $dataPendapatan[] = $totalPendapatanBulanan;
        }


        /*
        |--------------------------------------------------------------------------
        | CHART TAHUNAN
        |--------------------------------------------------------------------------
        */

        $labelTahunan = [];
        $dataTahunanTransaksi = [];
        $dataTahunanPendapatan = [];

        $tahunSekarang = date('Y');
        for ($tahun = $tahunSekarang - 4; $tahun <= $tahunSekarang; $tahun++) {
            $labelTahunan[] = $tahun;

            // Total transaksi tahunan
            $totalTransaksiTahunan = Transaksi::whereYear('tanggal_transaksi', $tahun)
                ->count();

            // Total pendapatan tahunan
            $totalPendapatanTahunan = Transaksi::whereYear('tanggal_transaksi', $tahun)
                ->where('status_transaksi', 'berhasil')
                ->sum('total_harga');

            $dataTahunanTransaksi[] = $totalTransaksiTahunan;

            $dataTahunanPendapatan[] = $totalPendapatanTahunan;
        }


        /*
        |--------------------------------------------------------------------------
        | CHART MINGGUAN
        |--------------------------------------------------------------------------
        */

        $chartMingguan = Transaksi::selectRaw('
                WEEK(tanggal_transaksi) as minggu,
                COUNT(*) as total
            ')
            ->whereMonth(
                'tanggal_transaksi',
                now()->month
            )
            ->whereYear(
                'tanggal_transaksi',
                now()->year
            )
            ->groupBy('minggu')
            ->orderBy('minggu')
            ->get();


        $labelMingguan = [];
        $dataMingguan = [];


        foreach ($chartMingguan as $item) {

            $labelMingguan[] =
                'Minggu ' . $item->minggu;

            $dataMingguan[] =
                $item->total;
        }


        /*
        |--------------------------------------------------------------------------
        | CHART STATUS
        |--------------------------------------------------------------------------
        */

        $chartStatus = [

            'berhasil' => Transaksi::where(
                'status_transaksi',
                'berhasil'
            )->count(),

            'menunggu_pembayaran' => Transaksi::where(
                'status_transaksi',
                'menunggu_pembayaran'
            )->count(),

            'menunggu_verifikasi' => Transaksi::where(
                'status_transaksi',
                'menunggu_verifikasi'
            )->count(),

            'perlu_upload_ulang' => Transaksi::where(
                'status_transaksi',
                'perlu_upload_ulang'
            )->count(),

            'ditolak' => Transaksi::where(
                'status_transaksi',
                'ditolak'
            )->count(),
        ];


        /*
        |--------------------------------------------------------------------------
        | RETURN VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'admin.laporan_penjualan',
            compact(

                'transaksi',

                'pendapatanBulanIni',
                'persenPendapatan',

                'totalTransaksi',
                'persenTransaksi',

                'totalPending',
                'persenPending',

                'totalBatal',
                'persenBatal',

                // 'chartPenjualan',
                'chartStatus',

                'labelBulanan',
                'dataTransaksi',
                'dataPendapatan',

                'labelTahunan',
                'dataTahunanTransaksi',
                'dataTahunanPendapatan',

                'labelMingguan',
                'dataMingguan'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | EXPORT CSV
    |--------------------------------------------------------------------------
    */

    public function export(Request $request)
    {
        $query = Transaksi::with([
            'user',
            'properti'
        ]);


        /*
        |--------------------------------------------------------------------------
        | FILTER TANGGAL
        |--------------------------------------------------------------------------
        */

        if (
            $request->filled('date_start') &&
            $request->filled('date_end')
        ) {

            $query->whereBetween(
                'tanggal_transaksi',
                [
                    $request->date_start . ' 00:00:00',
                    $request->date_end . ' 23:59:59'
                ]
            );
        }


        /*
        |--------------------------------------------------------------------------
        | FILTER STATUS
        |--------------------------------------------------------------------------
        */

        if (
            $request->filled('status_transaksi') &&
            $request->status_transaksi != 'all'
        ) {

            $query->where(
                'status_transaksi',
                $request->status_transaksi
            );
        }


        /*
        |--------------------------------------------------------------------------
        | FILTER TIPE PROPERTI
        |--------------------------------------------------------------------------
        */

        if (
            $request->filled('type') &&
            $request->type != 'all'
        ) {

            $query->whereHas(
                'properti',
                function ($q) use ($request) {

                    $q->where(
                        'tipe_properti',
                        $request->type
                    );

                }
            );
        }


        /*
        |--------------------------------------------------------------------------
        | DATA EXPORT
        |--------------------------------------------------------------------------
        */

        $transaksi = $query
            ->orderBy(
                'tanggal_transaksi',
                'desc'
            )
            ->get();


        $filename =
            'laporan_penjualan_' .
            now()->format('Ymd_His') .
            '.csv';


        $headers = [

            'Content-Type' =>
                'text/csv',

            'Content-Disposition' =>
                "attachment; filename=$filename",

        ];


        $callback = function () use ($transaksi) {

            $file = fopen(
                'php://output',
                'w'
            );


            /*
            |--------------------------------------------------------------------------
            | HEADER CSV
            |--------------------------------------------------------------------------
            */

            fputcsv($file, [

                'ID Transaksi',
                'Tanggal',
                'Pembeli',
                'Properti',
                'Metode Pembayaran',
                'Total Harga',
                'Status'

            ]);


            /*
            |--------------------------------------------------------------------------
            | DATA CSV
            |--------------------------------------------------------------------------
            */

            foreach ($transaksi as $item) {

                fputcsv($file, [
                    $item->id_transaksi,
                    $item->tanggal_transaksi,
                    $item->user->nama_user ?? '-',
                    $item->properti->nama_properti ?? '-',
                    $item->metode_pembayaran ?? '-',
                    $item->total_harga,
                    $item->status_transaksi
                ]);
            }

            fclose($file);
        };


        return response()->stream(
            $callback,
            200,
            $headers
        );
    }
}