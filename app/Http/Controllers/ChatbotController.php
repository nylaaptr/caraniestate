<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatBotController extends Controller
{
    public function sendMessage(Request $request)
    {
        $message = strtolower(trim($request->input('message')));
        
        // Database pengetahuan (bisa nanti dipindah ke database MySQL jika mau)
        $responses = [
            [
                'keywords' => ['halo', 'hai', 'hello', 'pagi', 'siang', 'malam'],
                'reply' => "Halo kak! 👋 Selamat datang di Carani Estate. Ada yang bisa dibantu hari ini?",
                'options' => ["Cari Rumah", "Info KPR", "Lokasi Kantor"]
            ],
            [
                'keywords' => ['harga', 'biaya', 'mahal', 'murah', 'budget', 'dp'],
                'reply' => "Untuk harga, kami punya banyak pilihan mulai dari Rp 500 jutaan sampai miliaran, Kak. 😊 Kamu lagi cari properti di daerah mana nih?",
                'options' => ["Daerah Malang", "Daerah Batu", "Budget < 1 Milyar"]
            ],
            [
                'keywords' => ['kpr', 'kredit', 'bank', 'cicil', 'bunga'],
                'reply' => "Siap! Untuk KPR, bunganya mulai dari 4% fixed tahun pertama lho. 🏦 Mau aku hitungin simulasi cicilannya sekalian?",
                'options' => ["Hitung Simulasi", "Syarat Dokumen"]
            ],
            [
                'keywords' => ['lokasi', 'alamat', 'dimana', 'tempat', 'kantornya'],
                'reply' => "Kantor pemasaran kami ada di pusat kota, strategis banget! 📍 Mau dikirim lokasi Google Maps-nya?",
                'options' => ["Kirim Peta", "Jadwalkan Kunjungan"]
            ],
            [
                'keywords' => ['tipe', 'jenis', 'rumah', 'apartemen', 'spesifikasi', 'luas'],
                'reply' => "Kami punya tipe Minimalis Modern dan Industrial Kekinian. Keduanya udah include kanopi & pagar loh! 🏠 Kamu lebih suka yang mana?",
                'options' => ["Lihat Foto Tipe A", "Lihat Foto Tipe B"]
            ]
        ];

        $bestMatch = null;
        $highestScore = 0;

        // Algoritma pencocokan sederhana (Naive Logic)
        foreach ($responses as $data) {
            $score = 0;
            foreach ($data['keywords'] as $keyword) {
                if (str_contains($message, $keyword)) {
                    $score++;
                }
            }
            if ($score > $highestScore) {
                $highestScore = $score;
                $bestMatch = $data;
            }
        }

        if ($bestMatch && $highestScore > 0) {
            return response()->json([
                'reply' => $bestMatch['reply'],
                'options' => $bestMatch['options']
            ]);
        } else {
            return response()->json([
                'reply' => "Waduh, maaf Kak, saya belum paham maksudnya 😅. Bisa coba tanya tentang 'Harga', 'KPR', atau 'Lokasi'?",
                'options' => ["Tanya Harga", "Tanya KPR"]
            ]);
        }
    }
}