<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Pembayaran</title>
    <style>
@page {
    margin: 8px;
}

body{
    font-family: DejaVu Sans, sans-serif;
    font-size:10px;
    color:#1e293b;
    margin:0;
    padding:0;
    background:#fff;
}

.invoice-container{
    width:100%;
    margin:0;
    padding:0;
}

/* HEADER */
.invoice-header{
    background:#1E3A5F;
    color:white;
    padding:10px 15px;
}

.company-info{
    width:100%;
}

.logo{
    width:40px;
    height:40px;
    float:left;
    margin-right:10px;
}

.logo img{
    width:100%;
    height:100%;
    object-fit:contain;
}

.company-name{
    font-size:15px;
    font-weight:bold;
}

.company-detail{
    font-size:9px;
    line-height:1.2;
}

.invoice-badge{
    text-align:right;
    margin-top:-35px;
}

.invoice-title{
    font-size:18px;
    font-weight:bold;
}

.status-paid,
.status-waiting,
.status-verification{
    padding:4px 10px;
    font-size:9px;
    border-radius:20px;
    color:white;
}

.status-paid{
    background:#22c55e;
}

.status-waiting{
    background:#f59e0b;
}

.status-verification{
    background:#3b82f6;
}

/* BODY */
.invoice-body{
    padding:12px 15px;
}

.top-info{
    width:100%;
}

.info-card{
    border:1px solid #ddd;
    padding:8px;
    margin-bottom:8px;
}

.info-title{
    font-size:10px;
    font-weight:bold;
    margin-bottom:6px;
    border-bottom:1px solid #ddd;
    padding-bottom:3px;
}

.info-item{
    margin-bottom:4px;
}

.info-label{
    font-weight:bold;
    font-size:9px;
}

/* TRANSFER */
.rekening-transfer{
    margin-bottom:10px;
}

.rekening-bank,
.rekening-box{
    padding:6px;
    border:1px solid #ddd;
}

.rekening-box span{
    font-size:11px;
    font-weight:bold;
}

/* PROPERTY */
.property-card{
    border:1px solid #ddd;
    padding:8px;
    margin-bottom:10px;
}

.section-title{
    font-size:11px;
    font-weight:bold;
    margin-bottom:6px;
}

.property-grid{
    width:100%;
}

.property-image{
    width:120px;
    height:80px;
    object-fit:cover;
    float:left;
    margin-right:10px;
}

.property-name{
    font-size:12px;
    font-weight:bold;
    margin-bottom:4px;
}

.property-detail{
    font-size:9px;
    margin-bottom:2px;
}

/* TABLE */
.payment-table{
    width:100%;
    border-collapse:collapse;
    margin-bottom:10px;
}

.payment-table th{
    background:#1E3A5F;
    color:white;
}

.payment-table th,
.payment-table td{
    border:1px solid #ddd;
    padding:5px;
    font-size:9px;
}

.text-right{
    text-align:right;
}

/* TOTAL */
.total-section{
    width:220px;
    margin-left:auto;
    border:1px solid #ddd;
    padding:8px;
}

.total-row{
    margin-bottom:4px;
}

.grand-total{
    border-top:1px solid #ddd;
    padding-top:4px;
    font-weight:bold;
    font-size:11px;
}

/* FOOTER */
.invoice-footer{
    margin-top:10px;
    border-top:1px solid #ddd;
    padding-top:6px;
}

.footer-note{
    font-size:8px;
    line-height:1.3;
}

/* DOMPDF */
*{
    page-break-inside: avoid;
}

.property-card,
.info-card,
.total-section,
.payment-table{
    page-break-inside: avoid;
}
</style>
</head>
<body>

<div class="invoice-container">

    <!-- HEADER -->
    <div class="invoice-header">

        <div class="company-info">

            <div class="logo">
                <img
    src="{{ storage_path('app/public/images/logoPT Pengguna.png') }}"
    alt="Logo Carani">
            </div>

            <div>
                <div class="company-name">PT. Carani Bhanu Balakosa</div>

                <div class="company-detail">
                    Jl. Raya Pakisan, Bunduh, Bataan, Kec. Tenggarang, Kabupaten Bondowoso, Jawa Timur  <br>
                    caranibhanubalakosa@gmail.com <br>
                    085755649471
                </div>
            </div>

        </div>

        <div class="invoice-badge">
            <div class="invoice-title">INVOICE</div>

            <div style="margin-bottom:10px; opacity:0.9;">
                INV-{{ $transaksi->id_transaksi }}
            </div>

            @if(!$transaksi->bukti_transaksi)

                <div class="status-waiting">
                    <i class="fas fa-clock"></i>
                    Menunggu Pembayaran
                </div>

            @elseif($transaksi->status_transaksi == 'menunggu_verifikasi')

                <div class="status-verification">
                    <i class="fas fa-search"></i>
                    Menunggu Verifikasi
                </div>

            @elseif($transaksi->status_transaksi == 'berhasil')

                <div class="status-paid">
                    <i class="fas fa-circle-check"></i>
                    Lunas
                </div>
            @endif
        </div>

    </div>

    <!-- BODY -->
    <div class="invoice-body">

        <!-- TOP INFO -->
        <div class="top-info">

            <div class="info-card">
                <div class="info-title">Data Pembeli</div>

                <div class="info-item">
                    <span class="info-label">Nama:</span>
                    {{ $transaksi->user->nama_user }}
                </div>

                <div class="info-item">
                    <span class="info-label">Email:</span>
                    {{ $transaksi->user->email_user }}
                </div>

                <div class="info-item">
                    <span class="info-label">Tanggal:</span>
                    {{ \Carbon\Carbon::parse($transaksi->created_at)->translatedFormat('d F Y') }}
                </div>
            </div>

            <div class="info-card">
                <div class="info-title">
                    Informasi Pembayaran
                </div>

                <div class="info-item">
                    <span class="info-label">Status</span>

                    <span class="status-tag status-wait">
                        Menunggu Pembayaran
                    </span>
                </div>

                <div class="info-item">
                    <span class="info-label">Jenis Transaksi</span>

                    {{ ucfirst($transaksi->jenis_transaksi) }}
                </div>

                <div class="info-item">
                    <span class="info-label">
                        Upload Bukti Sebelum
                    </span>

                    {{ \Carbon\Carbon::parse($transaksi->created_at)
                        ->addDays(1)
                        ->translatedFormat('d F Y') }}
                </div>

            </div>
        </div>

        <!-- PROPERTY -->
        <div class="property-card">

            <div class="section-title">
                Detail Properti
            </div>

            <div class="property-grid">
                <img
                src="{{ $transaksi->properti->gambar->first()
                    ? public_path('storage/images/' . $transaksi->properti->gambar->first()->path_gambar)
                    : public_path('images/placeholder-properti.png')
                }}"
                class="property-image">

                    <div class="property-name">
                        {{ $transaksi->properti->nama_properti }}
                    </div>

                    <div class="property-detail">
                        <strong>Perumahan:</strong>
                        {{ $transaksi->properti->perumahan->nama_perumahan ?? '-' }}
                    </div>

                    <div class="property-detail">
                        <strong>Blok:</strong>
                        {{ $transaksi->properti->blok->nama_blok ?? '-' }}
                    </div>

                    <div class="property-detail">
                        <strong>Status Unit:</strong>
                        {{ ucfirst($transaksi->properti->status_unit) }}
                    </div>

                </div>

            </div>

        </div>

        <!-- TABLE -->
        <div class="section-title">
            Rincian Pembayaran
        </div>

        <table class="payment-table">

            <thead>
                <tr>
                    <th>Deskripsi</th>
                    <th>Jumlah</th>
                    <th class="text-right">Total</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>Pembayaran Properti</td>
                    <td>1</td>
                    <td class="text-right">
                        Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}
                    </td>
                </tr>
            </tbody>

        </table>

        <!-- TOTAL -->
        <div class="total-section">

            <div class="total-row">
                <span>Subtotal</span>
                <span>
                    Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}
                </span>
            </div>

            <div class="total-row">
                <span>Biaya Admin</span>
                <span>Rp 0</span>
            </div>

            <div class="total-row grand-total">
                <span>Total</span>
                <span>
                    Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}
                </span>
            </div>
        </div>
        
        <!-- FOOTER -->
        <div class="invoice-footer">

            <div class="footer-note">
                Terima kasih telah melakukan pembayaran di Carani Estate.
                Invoice ini dibuat otomatis oleh sistem setelah pembayaran
                berhasil diverifikasi oleh admin.
            </div>

        </div>
    </div>
    @if(session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
    @endif
    
</div>

</body>
</html>

