<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Pembayaran</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
:root {
    --primary-blue: #7AB2D3;
    --primary-blue-rgb: 122, 178, 211;
    --dark-blue: #1E3A5F;
    --light-blue: #e6f2f8;
    --sidebar-width: 260px;
}

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background:#f1f5f9;
            padding:40px 20px;
            color:#1e293b;
        }

        .invoice-container{
            max-width:950px;
            margin:auto;
            background:white;
            border-radius:24px;
            overflow:hidden;
            box-shadow:0 10px 40px rgba(0,0,0,0.08);
        }

        /* HEADER */
        .invoice-header{
            background:linear-gradient(135deg, #1E3A5F 0%, #284f80 100%);
            color:white;
            padding:35px;
            display:flex;
            justify-content:space-between;
            align-items:flex-start;
            flex-wrap:wrap;
            gap:20px;
        }

        .company-info{
            display:flex;
            gap:18px;
        }

        .logo{
            width:70px;
            height:70px;
            border-radius:18px;
            background:white;
            display:flex;
            align-items:center;
            justify-content:center;
            color:#1E3A5F;
            font-size:30px;
        }

        .company-name{
            font-size:1.7rem;
            font-weight:700;
            margin-bottom:6px;
        }

        .company-detail{
            font-size:0.95rem;
            opacity:0.9;
            line-height:1.6;
        }

        .invoice-badge{
            text-align:right;
        }

        .invoice-title{
            font-size:2rem;
            font-weight:800;
            margin-bottom:10px;
        }

        .status-paid{
            display:inline-block;
            background:#22c55e;
            color:white;
            padding:8px 18px;
            border-radius:999px;
            font-size:0.9rem;
            font-weight:600;
        }

        /* BODY */
        .invoice-body{
            padding:35px;
        }

        .top-info{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
            gap:24px;
            margin-bottom:35px;
        }

        .info-card{
            background:white;
            border:1px solid #e2e8f0;
            border-radius:20px;
            padding:24px;

            box-shadow:
                0 4px 12px rgba(15,23,42,.04);

            transition:.3s;
        }

        .info-card:hover{
            transform:translateY(-2px);
        }

        .info-title{
            font-size:.85rem;
            font-weight:700;
            color:#64748b;

            text-transform:uppercase;
            letter-spacing:1px;

            margin-bottom:20px;
            padding-bottom:12px;

            border-bottom:1px solid #e2e8f0;
        }

        .info-item{
            margin-bottom:18px;
        }

        .info-item:last-child{
            margin-bottom:0;
        }

        .info-label{
            display:block;

            font-size:.75rem;
            font-weight:700;

            color:#94a3b8;

            text-transform:uppercase;
            letter-spacing:1px;

            margin-bottom:6px;
        }

        /* =====================================
        INFORMASI TRANSFER
        ===================================== */

        .rekening-transfer{
            margin-bottom:35px;
            background:linear-gradient(
                135deg,
                #eef7fc 0%,
                #f8fbfd 100%
            );
            border:1px solid #cfe3ef;
        }

        .rekening-transfer .info-title{
            color:#1E3A5F;
            font-size:1rem;
        }

        .rekening-transfer .info-item{
            margin-bottom:18px;
        }

        .rekening-transfer strong{
            display:block;
            margin-bottom:8px;
            color:#475569;
            font-size:.9rem;
        }

        .rekening-bank{
            background:white;
            border:1px solid #dbeafe;
            padding:12px 16px;
            border-radius:12px;
            font-weight:600;
        }

        .rekening-box{
            display:flex;
            justify-content:space-between;
            align-items:center;
            gap:15px;

            background:white;
            border:2px dashed #7AB2D3;

            padding:16px 18px;
            border-radius:14px;
        }

        .rekening-box span{
            font-size:1.2rem;
            font-weight:700;
            color:#1E3A5F;
            letter-spacing:1px;
        }

        .copy-btn{
            border:none;
            background:#1E3A5F;
            color:white;

            padding:10px 16px;
            border-radius:10px;

            cursor:pointer;
            font-weight:600;

            display:flex;
            align-items:center;
            gap:8px;

            transition:.3s;
        }

        .copy-btn:hover{
            background:#284f80;
            transform:translateY(-2px);
        }

        /* PROPERTY */
        .property-card{
            background:#f8fafc;
            border:1px solid #e2e8f0;
            border-radius:20px;
            padding:25px;

            margin-top:40px;
            margin-bottom:35px;
        }

        .section-title{
            font-size:1.2rem;
            font-weight:700;
            margin-bottom:20px;
            color:#1E3A5F;
        }

        .property-grid{
            display:grid;
            grid-template-columns:220px 1fr;
            gap:25px;
            align-items:center;
        }

        .property-image{
            width:100%;
            height:170px;
            border-radius:16px;
            object-fit:cover;
        }

        .property-name{
            font-size:1.4rem;
            font-weight:700;
            margin-bottom:14px;
        }

        .property-detail{
            margin-bottom:10px;
            color:#475569;
        }

        /* TABLE */
        .payment-table{
            width:100%;
            border-collapse:collapse;
            margin-bottom:30px;
        }

        .payment-table thead{
            background:#1E3A5F;
            color:white;
        }

        .payment-table th,
        .payment-table td{
            padding:16px;
            text-align:left;
        }

        .payment-table tbody tr{
            border-bottom:1px solid #e2e8f0;
        }

        .payment-table tbody tr:last-child{
            border-bottom:none;
        }

        .text-right{
            text-align:right;
        }

        /* TOTAL */
        .total-section{
            margin-left:auto;
            width:320px;
            background:#f8fafc;
            border-radius:18px;
            padding:24px;
            border:1px solid #e2e8f0;
        }

        .total-row{
            display:flex;
            justify-content:space-between;
            margin-bottom:14px;
            color:#475569;
        }

        .grand-total{
            border-top:2px dashed #cbd5e1;
            margin-top:16px;
            padding-top:16px;
            font-size:1.3rem;
            font-weight:800;
            color:#1E3A5F;
        }

        /* CSS POP UP */
        .image-modal{
            display:none;
            position:fixed;
            z-index:9999;
            left:0;
            top:0;
            width:100%;
            height:100%;
            background:rgba(0,0,0,.9);

            justify-content:center;
            align-items:center;
        }

        .modal-image{
            max-width:90%;
            max-height:90%;
            border-radius:12px;
        }

        .close-modal{
            position:absolute;
            top:20px;
            right:35px;
            color:white;
            font-size:40px;
            cursor:pointer;
            font-weight:bold;
        }

        .close-modal:hover{
            opacity:.7;
        }

        /* FOOTER */
        .invoice-footer{
            margin-top:40px;
            padding-top:30px;
            border-top:1px solid #e2e8f0;
            display:flex;
            justify-content:space-between;
            gap:20px;
            flex-wrap:wrap;
        }

        .footer-note{
            color:#64748b;
            line-height:1.7;
            max-width:500px;
        }

        .action-buttons{
            display:flex;
            gap:14px;
            flex-wrap:wrap;
        }

        .btn{
            padding:14px 22px;
            border:none;
            border-radius:14px;
            text-decoration:none;
            font-weight:600;
            cursor:pointer;
            transition:0.3s ease;
            display:flex;
            align-items:center;
            gap:10px;
        }

        .btn-primary{
            background:#1E3A5F;
            color:white;
        }

        .btn-primary:hover{
            background:#284f80;
        }

        .btn-outline{
            background:white;
            border:1px solid #cbd5e1;
            color:#334155;
        }

        .btn-outline:hover{
            background:#f8fafc;
        }

        .alert-success{
            background:#dcfce7;
            color:#166534;
            padding:15px;
            border-radius:12px;
            margin-bottom:20px;
            border:1px solid #86efac;
        }

        /* =====================================
        UPLOAD BUKTI PEMBAYARAN
        ===================================== */

        .upload-section{
            margin-top:35px;
            background:linear-gradient(
                135deg,
                #f8fbfd 0%,
                #eef6fa 100%
            );
            border:1px solid #dbeafe;
            border-radius:20px;
            padding:28px;
            box-shadow:0 8px 25px rgba(122,178,211,0.12);
        }

        .upload-section h3{
            color:#1E3A5F;
            font-size:1.25rem;
            font-weight:700;
            margin-bottom:20px;
            display:flex;
            align-items:center;
            gap:10px;
        }

        .upload-section h3::before{
            content:"📤";
            font-size:1.2rem;
        }

        .upload-section form{
            display:flex;
            flex-direction:column;
            gap:18px;
        }

        .upload-section input[type="file"]{
            width:100%;
            padding:14px;
            border:2px dashed #7AB2D3;
            border-radius:16px;
            background:white;
            cursor:pointer;
            transition:0.3s ease;
            color:#475569;
            font-size:0.95rem;
        }

        .upload-section input[type="file"]:hover{
            border-color:#1E3A5F;
            background:#f8fafc;
        }

        .upload-section input[type="file"]::file-selector-button{
            background:#1E3A5F;
            color:white;
            border:none;
            padding:10px 16px;
            border-radius:10px;
            margin-right:15px;
            cursor:pointer;
            font-weight:600;
            transition:.3s;
        }

        .upload-section input[type="file"]::file-selector-button:hover{
            background:#284f80;
        }

        .upload-section .btn{
            width:fit-content;
            min-width:180px;
        }

        /* =====================================
        PREVIEW BUKTI PEMBAYARAN
        ===================================== */

        .property-card img{
            max-width:100%;
            width:350px;
            border-radius:16px;
            border:1px solid #e2e8f0;
            box-shadow:0 10px 25px rgba(0,0,0,0.08);
            transition:.3s ease;
        }

        .property-card img:hover{
            transform:scale(1.02);
        }

        /* =====================================
        STATUS BADGE
        ===================================== */

        .status-waiting{
            display:inline-block;
            background:#f59e0b;
            color:white;
            padding:8px 18px;
            border-radius:999px;
            font-size:.9rem;
            font-weight:600;
        }

        .status-verification{
            display:inline-block;
            background:#3b82f6;
            color:white;
            padding:8px 18px;
            border-radius:999px;
            font-size:.9rem;
            font-weight:600;
        }

        @media(max-width:768px){

            body{
                padding:20px 10px;
            }

            .invoice-header,
            .invoice-body{
                padding:24px;
            }

            .property-grid{
                grid-template-columns:1fr;
            }

            .invoice-badge{
                text-align:left;
            }

            .total-section{
                width:100%;
            }

            .invoice-footer{
                flex-direction:column;
            }
        }

        @media print{

    body{
        margin:0;
        padding:0;
        background:white;
    }

    .invoice-container{
        width:100%;
        max-width:100%;
        margin:0;
        box-shadow:none;
        border-radius:0;
    }

    .action-buttons,
    .upload-section,
    .rekening-transfer,
    .alert-success{
        display:none !important;
    }

    .property-card{
        margin-top:10px;
        margin-bottom:10px;
        padding:10px;
    }

    .info-card{
        margin-bottom:8px;
        padding:10px;
    }

    .invoice-body{
        padding:15px;
    }

    .invoice-header{
        padding:15px;
    }
}
    </style>
</head>
<body>

<div class="invoice-container">

    <!-- HEADER -->
    <div class="invoice-header">

        <div class="company-info">

            <div class="logo">
                <i class="fas fa-home"></i>
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

        <div class="info-card rekening-transfer">
            <div class="info-title">
                Informasi Transfer Pembayaran
            </div>

            <div class="info-item">
                <strong>Bank Tujuan</strong>
                <div class="rekening-bank">
                    BCA
                </div>
            </div>

            <div class="info-item">
                <strong>Nomor Rekening</strong>

                <div class="rekening-box">

                    <span id="nomorRekening">
                        1430033363555
                    </span>

                    <button
                        type="button"
                        class="copy-btn"
                        onclick="copyRekening()">

                        <i class="fas fa-copy"></i>
                        Salin
                    </button>

                </div>
            </div>

            <div class="info-item">
                <strong>Atas Nama</strong>

                <div class="rekening-bank">
                    PT Carani Bhanu Balakosa
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
                    ? asset('storage/images/' . $transaksi->properti->gambar->first()->path_gambar)
                    : asset('images/placeholder-properti.png')
                }}"
                class="property-image"
                alt="{{ $transaksi->properti->nama_properti }}">

                <div>

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

        @if(!$transaksi->bukti_transaksi)

        <div class="upload-section">

            <h3>Upload Bukti Pembayaran</h3>

            <form
                action="{{ route('user.upload.bukti') }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf

                <input
                    type="hidden"
                    name="id_transaksi"
                    value="{{ $transaksi->id_transaksi }}">

                <input
                    type="file"
                    name="bukti_pembayaran"
                    required>

                <button
                    type="submit"
                    class="btn btn-primary">

                    Upload Bukti
                </button>
            </form>
        </div>

        @endif

        @if($transaksi->bukti_pembayaran)
        <div class="property-card">

            <div style="
                display:flex;
                justify-content:space-between;
                align-items:center;
                margin-bottom:15px;
            ">

                <div class="section-title" style="margin:0;">
                    Bukti Pembayaran
                </div>

                <button
                    type="button"
                    onclick="openImageModal('{{ asset('storage/'.$transaksi->bukti_pembayaran) }}')"
                    style="
                        border:none;
                        background:#2563eb;
                        color:white;
                        width:40px;
                        height:40px;
                        border-radius:50%;
                        cursor:pointer;
                    ">

                    <i class="fas fa-eye"></i>

                </button>

            </div>

            <img
                src="{{ asset('storage/'.$transaksi->bukti_pembayaran) }}"
                style="
                    max-width:300px;
                    border-radius:12px;
                ">
        </div>
        @endif

        <div id="previewContainer" style="display:none; margin-top:15px;">

            <div style="
                display:flex;
                justify-content:space-between;
                align-items:center;
                margin-bottom:10px;
            ">

                <strong>Preview Bukti Pembayaran</strong>

                <button
                    type="button"
                    onclick="openImageModal()"
                    class="btn btn-primary">

                    <i class="fas fa-eye"></i>
                </button>

            </div>

            <img
                id="previewImage"
                style="
                    max-width:300px;
                    border-radius:12px;
                    border:1px solid #ddd;
                ">

        </div>
        <div class="action-buttons">

            <a href="{{ route('detail-pemesanan', $transaksi->pemesanan->id_pemesanan) }}"
            class="btn btn-outline">
                <i class="fas fa-arrow-left"></i>
                Kembali
            </a>

        </div>
        <!-- FOOTER -->
        <div class="invoice-footer">

            <div class="footer-note">
                Terima kasih telah melakukan pembayaran di Carani Estate.
                Invoice ini dibuat otomatis oleh sistem setelah pembayaran
                berhasil diverifikasi oleh admin.
            </div>

            @if($transaksi->status_transaksi == 'berhasil')
            <div class="action-buttons">
<!-- 
                <button onclick="window.print()" class="btn btn-outline">
                    <i class="fas fa-print"></i>
                    Cetak Invoice
                </button> -->

                <a
                    href="{{ route('invoice.pdf', $transaksi->id_transaksi) }}"
                    class="btn btn-primary">

                    <i class="fas fa-download"></i>
                    Download PDF
                </a>

            </div>

            @endif
        </div>
    </div>
    @if(session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
    @endif
    
</div>

<script>
let currentPreview = '';

document.querySelector(
    'input[name="bukti_pembayaran"]'
).addEventListener('change', function(e){

    const file = e.target.files[0];

    if(!file) return;

    const reader = new FileReader();

    reader.onload = function(event){

        currentPreview = event.target.result;

        document.getElementById('previewImage').src =
            currentPreview;

        document.getElementById('previewContainer').style.display =
            'block';
    };

    reader.readAsDataURL(file);
});

function openImageModal(){

    document.getElementById('modalImage').src =
        currentPreview;

    document.getElementById('imageModal').style.display =
        'flex';
}
</script>

<script>
// SALIN REKENING
function copyRekening(){

    const rekening =
        document.getElementById(
            'nomorRekening'
        ).innerText;

    navigator.clipboard.writeText(rekening);

    alert('Nomor rekening berhasil disalin');
}
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Berhasil',
    text: '{{ session('success') }}',
    confirmButtonColor: '#1E3A5F'
});
</script>
@endif

<!-- Modal Preview Gambar -->
<div
    id="imageModal"
    style="
        display:none;
        position:fixed;
        inset:0;
        background:rgba(0,0,0,.8);
        justify-content:center;
        align-items:center;
        z-index:9999;
    ">

    <span
        onclick="document.getElementById('imageModal').style.display='none'"
        style="
            position:absolute;
            top:20px;
            right:30px;
            color:white;
            font-size:35px;
            cursor:pointer;
        ">
        &times;
    </span>

    <img
        id="modalImage"
        style="
            max-width:90%;
            max-height:90%;
            border-radius:12px;
        ">
</div>
</body>
</html>
```
