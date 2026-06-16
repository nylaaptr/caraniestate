<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Perumahan;
use App\Models\Blok;
use App\Models\GambarProperti;

class Properti extends Model
{
    // ✅ Nama tabel (jika tidak mengikuti konvensi plural)
    protected $table = 'properti';

    // ✅ PRIMARY KEY CUSTOM (WAJIB - ini yang missing!)
    protected $primaryKey = 'id_properti';

    // ✅ Jika id_properti adalah auto-increment integer
    public $incrementing = true;
    protected $keyType = 'int';

    // ✅ Kolom yang boleh diisi mass-assignment (opsional tapi disarankan)
    protected $fillable = [
        'nama_properti',
        'harga_properti',
        'tipe_properti',
        'kategori_properti',
        'jenis_properti',
        'status_unit',
        'id_perumahan',
        'id_blok',

        'bookingFee',
        'luas_bangunan',
        'luas_tanah',
        'stok_unit',

        'deskripsi',
    ];

    // ✅ Relationship ke Perumahan
    public function perumahan()
    {
        return $this->belongsTo(Perumahan::class, 'id_perumahan', 'id_perumahan');
    }

    // ✅ Relationship ke Blok
    public function blok()
    {
        return $this->belongsTo(Blok::class, 'id_blok', 'id_blok');
    }

    // ✅ BONUS: Accessor untuk info tambahan (tanpa ubah database)
    // Contoh: Menampilkan "Keunggulan" berdasarkan kategori
    public function getKeunggulanAttribute()
    {
        if ($this->kategori_properti == 'subsidi') {
            return [
                'Proses KPR Mudah',
                'Bebas Biaya BPHTB',
                'Sertifikat SHM',
                'Lingkungan Asri'
            ];
        }
        
        return [
            'Desain Modern Minimalis',
            'Material Premium',
            'Smart Home Ready',
            'Green Open Space 30%'
        ];
    }

    // ✅ BONUS: Estimasi cicilan KPR (contoh logika)
    public function getEstimasiCicilanAttribute()
    {
        $dp = $this->harga_properti * 0.1; // DP 10%
        $sisa = $this->harga_properti - $dp;
        $cicilan = $sisa / 180; // 15 tahun = 180 bulan
        
        return 'Rp ' . number_format($cicilan, 0, ',', '.');
    }

    // RELASI KE GAMBAR PROPERTI
    public function gambar()
{
    return $this->hasMany(GambarProperti::class, 'id_properti', 'id_properti');
}
}