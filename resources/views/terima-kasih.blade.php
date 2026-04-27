<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan Berhasil - Carani Estate</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: #f8fafc;
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .card-sukses {
            background: white;
            border-radius: 20px;
            padding: 50px 40px;
            text-align: center;
            max-width: 520px;
            width: 100%;
            box-shadow: 0 10px 40px rgba(0,0,0,0.08);
        }
        .icon-sukses {
            width: 90px;
            height: 90px;
            background: #d1fae5;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
        }
        .icon-sukses i {
            font-size: 40px;
            color: #059669;
        }
        .judul {
            font-size: 1.8rem;
            font-weight: 700;
            color: #1E3A5F;
            margin-bottom: 10px;
        }
        .subjudul {
            color: #64748b;
            font-size: 1rem;
            margin-bottom: 30px;
            line-height: 1.6;
        }
        .info-box {
            background: #f1f5f9;
            border-radius: 12px;
            padding: 20px;
            text-align: left;
            margin-bottom: 25px;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #e2e8f0;
            font-size: 0.95rem;
        }
        .info-row:last-child { border-bottom: none; }
        .info-label { color: #64748b; }
        .info-value { font-weight: 600; color: #1E3A5F; }
        .status-pill {
            background: #fef3c7;
            color: #f59e0b;
            padding: 4px 14px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }
        .steps {
            background: #eff6ff;
            border-radius: 12px;
            padding: 20px;
            text-align: left;
            margin-bottom: 30px;
        }
        .steps h6 {
            color: #1E3A5F;
            font-weight: 700;
            margin-bottom: 12px;
        }
        .step-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 10px;
            font-size: 0.9rem;
            color: #475569;
        }
        .step-num {
            width: 24px;
            height: 24px;
            background: #7AB2D3;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: 700;
            flex-shrink: 0;
        }
        .btn-notif {
            background: #7AB2D3;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 10px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            margin: 5px;
            transition: all 0.3s;
        }
        .btn-notif:hover { background: #6aa5c6; color: white; }
        .btn-outline {
            background: transparent;
            color: #7AB2D3;
            border: 2px solid #7AB2D3;
            padding: 12px 30px;
            border-radius: 10px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            margin: 5px;
            transition: all 0.3s;
        }
        .btn-outline:hover { background: #7AB2D3; color: white; }
    </style>
</head>
<body>
    <div class="card-sukses">
        <div class="icon-sukses">
            <i class="fas fa-check"></i>
        </div>

        <h1 class="judul">Pemesanan Berhasil!</h1>
        <p class="subjudul">
            Dokumen kamu sudah kami terima. Admin akan memverifikasi dokumenmu 
            dan kamu akan mendapat notifikasi setelah proses selesai.
        </p>

        {{-- Info Transaksi --}}
        <div class="info-box">
            <div class="info-row">
                <span class="info-label">Properti</span>
                <span class="info-value">{{ $transaksi->properti->nama_properti ?? '-' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Jenis Transaksi</span>
                <span class="info-value">{{ ucfirst($transaksi->jenis_transaksi) }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Total Harga</span>
                <span class="info-value">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Tanggal</span>
                <span class="info-value">{{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('d M Y') }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Status</span>
                <span class="status-pill"><i class="fas fa-clock"></i> Menunggu Verifikasi</span>
            </div>
        </div>

        {{-- Langkah Selanjutnya --}}
        <div class="steps">
            <h6><i class="fas fa-list-ol"></i> Langkah Selanjutnya</h6>
            <div class="step-item">
                <div class="step-num">1</div>
                <span>Admin akan mengecek dokumen yang kamu kirimkan</span>
            </div>
            <div class="step-item">
                <div class="step-num">2</div>
                <span>Kamu akan mendapat notifikasi jika dokumen disetujui atau perlu diperbaiki</span>
            </div>
            <div class="step-item">
                <div class="step-num">3</div>
                <span>Setelah disetujui, kamu bisa melanjutkan ke proses pembayaran</span>
            </div>
        </div>

        {{-- Tombol --}}
        <div>
            <a href="{{ route('halaman-notifikasi') }}" class="btn-notif">
                <i class="fas fa-bell"></i> Lihat Notifikasi
            </a>
            <a href="{{ route('halaman-katalog') }}" class="btn-outline">
                <i class="fas fa-home"></i> Kembali ke Katalog
            </a>
        </div>
    </div>
</body>
</html>