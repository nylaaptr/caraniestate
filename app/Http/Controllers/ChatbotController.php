<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// app/Http/Controllers/ChatbotController.php
class ChatbotController extends Controller
{
    public function index()
    {
        return view('halaman-chatbot');
    }

    public function reply(Request $request)
    {
        $pesan = strtolower($request->input('pesan'));
        $balasan = $this->prosesPersan($pesan);

        // Simpan ke tabel chat_messages
        ChatMessage::create([
            'session_id' => session()->getId(),
            'pengirim'   => 'user',
            'pesan'      => $request->input('pesan'),
        ]);
        ChatMessage::create([
            'session_id' => session()->getId(),
            'pengirim'   => 'bot',
            'pesan'      => $balasan,
        ]);

        return response()->json(['balasan' => $balasan]);
    }

    private function prosesPersan($pesan)
    {
        // Rekomendasi berdasarkan budget
        if (str_contains($pesan, 'subsidi') || str_contains($pesan, 'murah')) {
            return $this->rekomendasiProperti('subsidi');
        }
        if (str_contains($pesan, 'type 36') || str_contains($pesan, 'tipe 36')) {
            return $this->rekomendasiProperti('36');
        }
        if (str_contains($pesan, 'type 45') || str_contains($pesan, 'tipe 45')) {
            return $this->rekomendasiProperti('45');
        }
        if (str_contains($pesan, 'ruko')) {
            return $this->rekomendasiProperti('ruko');
        }

        // Pertanyaan harga
        if (str_contains($pesan, 'harga') || str_contains($pesan, 'berapa')) {
            return "Harga properti kami mulai dari:\n
            - Type 30 (Subsidi): Rp 162.000.000\n
            - Type 36: Rp 200.000.000\n
            - Type 45: Rp 300.000.000\n
            - Type 60: Rp 435.000.000\n
            - Ruko: Rp 600.000.000\n
            Mau tanya type yang mana?";
        }

        // Pertanyaan KPR
        if (str_contains($pesan, 'kpr') || str_contains($pesan, 'kredit')) {
            return "Kami melayani KPR dengan tenor 10-20 tahun. 
            Syaratnya KTP, KK, slip gaji, dan NPWP. 
            Mau tahu cicilan untuk type berapa?";
        }

        // Pertanyaan cicilan
        if (str_contains($pesan, 'cicil') || str_contains($pesan, 'angsuran')) {
            return "Estimasi angsuran KPR per bulan:\n
            - Type 36 (10th): Rp 1.875.900\n
            - Type 45 (10th): Rp 2.813.800\n
            - Type 60 (10th): Rp 4.080.000\n
            Mau simulasi tenor yang lain?";
        }

        // Salam
        if (str_contains($pesan, 'halo') || str_contains($pesan, 'hai') || 
            str_contains($pesan, 'hello')) {
            return "Halo! Selamat datang di Kelapa Gading Regency 🏠
            Saya siap membantu kamu menemukan rumah impian.
            Boleh saya tahu budget dan kebutuhan kamu?";
        }

        // Default
        return "Maaf, saya belum mengerti pertanyaanmu. 
        Kamu bisa tanya tentang:\n
        - Harga properti\n
        - Type rumah (36, 45, 60, Ruko)\n
        - KPR & cicilan\n
        - Cara booking";
    }

    private function rekomendasiProperti($type)
    {
        $properti = Properti::where('type', 'like', "%$type%")
                    ->where('status', 'tersedia')
                    ->get();

        if ($properti->isEmpty()) {
            return "Maaf, properti type $type sedang tidak tersedia. 
            Mau lihat type lain?";
        }

        $hasil = "Rekomendasi properti type $type yang tersedia:\n";
        foreach ($properti as $p) {
            $hasil .= "- Blok {$p->blok}, Harga: Rp " . 
                    number_format($p->harga, 0, ',', '.') . "\n";
        }
        return $hasil;
    }
}
