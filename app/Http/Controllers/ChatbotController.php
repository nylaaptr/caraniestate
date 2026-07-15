<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\ChatSession;
use App\Models\ChatbotMessage;

class ChatbotController extends Controller
{
    // =========================
    // HALAMAN CHATBOT
    // =========================
    public function index()
    {
        $chatSession = ChatSession::with([
            'messages' => function ($q) {
                $q->orderBy('created_at', 'asc');
            }
        ])
        ->where('id_user', auth()->id())
        ->where('status_chat', 'aktif')
        ->first();

        $messages = $chatSession
            ? $chatSession->messages
            : collect([]);

        return view(
            'halaman-chatbot',
            compact(
                'chatSession',
                'messages'
            )
        );
    }


    // =========================
    // KIRIM CHAT
    // =========================
    public function kirim(Request $request)
    {
        $pesanUser = $request->input('message');
        $pesanLower = strtolower($pesanUser);

        $keywordProperti = [
            'rumah',
            'properti',
            'katalog',
            'ruko',
            'subsidi',
            'tipe',
            'cluster',
            'unit',
            'harga',
            'beli rumah',
            'cari rumah',
            'lihat rumah',
            'lihat katalog',
            'show katalog',
            'perumahan'
        ];

        $perluTampilkanKatalog = false;

        foreach ($keywordProperti as $keyword) {
            if (str_contains($pesanLower, $keyword)) {
                $perluTampilkanKatalog = true;
                break;
            }
        }

        $userId = Auth::id();

        // =========================
        // CEK SESSION CHAT
        // =========================
        $chatSession = DB::table('chat_sessions')
            ->where('id_user', $userId)
            ->where('status_chat', 'aktif')
            ->first();

        // kalau belum ada session
        if (!$chatSession) {

            $sessionId =
                DB::table('chat_sessions')
                ->insertGetId([
                    'id_user' => $userId,
                    'status_chat' => 'aktif',
                    'started_at' => now(),
                    'ended_at' => now()
                ]);

        } else {

            $sessionId =
                $chatSession->id_sessions;
                session([
                'chat_session_id' => $sessionId
            ]);
        }


        // =========================
        // SIMPAN CHAT USER
        // =========================
        DB::table('chat_messages')->insert([
            'id_sessions' => $sessionId,
            'sender' => 'user',
            'message' => $pesanUser,
            'created_at' => now()
        ]);


        // =========================
        // DEFAULT
        // =========================
        $rekomendasiProperti = [];

        $balasan = 'Maaf kak, terjadi kesalahan 😥';


        // =========================
        // API KEY
        // =========================
        $apiKey = env('GROQ_API_KEY');

        if (!$apiKey) {
            return response()->json([
                'reply' => 'API key tidak ditemukan!',
                'options' => [],
                'properti' => []
            ]);
        }


        // =========================
        // DATA PROPERTI
        // =========================
        $properti = DB::table('properti')
            ->where('status_unit', 'tersedia')
            ->select(
                'id_properti',
                'nama_properti',
                'jenis_properti',
                'kategori_properti',
                'tipe_properti',
                'harga_properti',
                'luas_bangunan',
                'luas_tanah',
                'stok_unit'
            )
            ->get();

        $propertiJson =
            json_encode($properti);


        // =========================
        // SYSTEM PROMPT
        // =========================
        $systemPrompt = "
Kamu adalah CaraniBot, customer service virtual PT. Carani Bhanu Balakosa.

Gaya bicara:
- Santai
- Natural
- Ramah
- Seperti admin chat WhatsApp
- Jangan terlalu formal
- Jangan terlalu kaku
- Gunakan emoji seperlunya 😊
- Panggil user dengan 'kak' jika cocok

ATURAN PENTING:
- DILARANG menggunakan markdown.
- DILARANG menggunakan tanda bintang seperti * atau **.
- DILARANG membuat bullet list.
- DILARANG membuat format poin-poin.
- Balasan harus seperti chat biasa.
- Gunakan kalimat natural dan mengalir.
- Jangan terlalu panjang.

Jika user baru menyebut ingin cari rumah/properti:
- Jangan langsung memberi rekomendasi properti.
- Tanya kebutuhan user dulu secara natural.

Contoh gaya yang BENAR:
'Siap kak 😊
Boleh tahu budget dan lokasi yang kakak inginkan?'

Contoh gaya yang SALAH:
'* Budget? *
* Lokasi? *'

Kamu bisa membantu:
- konsultasi properti
- rekomendasi rumah
- KPR
- subsidi
- lokasi properti
- harga rumah
- proses pembelian
- pertanyaan umum pelanggan

Data properti:
$propertiJson

Jika ingin merekomendasikan properti, gunakan format:
[REKOMENDASI:id]

Jika pengguna meminta melihat rumah, properti, ruko, katalog, unit, atau mencari rumah berdasarkan budget, lokasi, tipe, maupun kategori, WAJIB sertakan tag:
[REKOMENDASI:id]

Contoh:
[REKOMENDASI:1,2]
";






        try {

            $client = new \GuzzleHttp\Client();

            $response = $client->post(
                'https://api.groq.com/openai/v1/chat/completions',
                [

                    'headers' => [

                        'Content-Type' => 'application/json',

                        'Authorization' => 'Bearer ' . $apiKey
                    ],

                    'json' => [
                        'model' => 'llama-3.1-8b-instant',
                        'max_tokens' => 500,
                        'messages' => [

                            [
                                'role' => 'system',
                                'content' => $systemPrompt
                            ],

                            [
                                'role' => 'user',
                                'content' => $pesanUser
                            ]
                        ]
                    ]
                ]
            );

            $result =
                json_decode(
                    $response->getBody(),
                    true
                );

            $balasan =
                $result['choices'][0]['message']['content']
                ?? 'Tidak ada balasan';
                Log::info($balasan);


            // =========================
            // CEK TAG REKOMENDASI
            // =========================
            if (
                preg_match(
                    '/\[REKOMENDASI:([\d,]+)\]/',
                    $balasan,
                    $matches
                )
            ) {

                $ids =
                    explode(',', $matches[1]);

                $rekomendasiProperti =
                    DB::table('properti')
                    ->whereIn(
                        'id_properti',
                        $ids
                    )
                    ->where(
                        'status_unit',
                        'tersedia'
                    )
                    ->select(
                        'id_properti',
                        'nama_properti',
                        'jenis_properti',
                        'kategori_properti',
                        'tipe_properti',
                        'harga_properti',
                        'luas_bangunan',
                        'luas_tanah',
                        'stok_unit'
                    )
                    ->get(1)
                    ->toArray();

                // hapus tag dari chat
                $balasan = trim(
                    preg_replace(
                        '/\[REKOMENDASI:[\d,]+\]/',
                        '',
                        $balasan
                    )
                );
            }

                    } catch (\Exception $e) {

            $balasan =
                'Maaf kak, server lagi gangguan 😥';

            $rekomendasiProperti = [];
        }

        // =========================
        // SIMPAN BALASAN BOT
        // =========================
        DB::table('chat_messages')->insert([
            'id_sessions' => $sessionId,
            'sender' => 'bot',
            'message' => $balasan,
            'properti_data' => json_encode($rekomendasiProperti),
            'created_at' => now()
        ]);


        // =========================
        // RESPONSE JSON
        // =========================
        return response()->json([
            'reply' => $balasan,
            'options' => [],
            'properti' => $rekomendasiProperti
        ]);
    }


    // =========================
    // HAPUS RIWAYAT CHAT
    // =========================
    public function hapusRiwayat()
    {
        $userId = auth()->id();

        $session = DB::table('chat_sessions')
            ->where('id_user', $userId)
            ->where('status_chat', 'aktif')
            ->first();

        if ($session) {

            DB::table('chat_messages')
                ->where('id_sessions', $session->id_sessions)
                ->delete();

            DB::table('chat_sessions')
                ->where('id_sessions', $session->id_sessions)
                ->delete();
        }

        return response()->json([
            'success' => true
        ]);
    }

    // PESAN TERBARU
    public function pesanTerbaru(Request $request)
{
    $sessionId = session('chat_session_id');

    if (!$sessionId) {

        return response()->json([
            'messages' => []
        ]);
    }

    $lastId = $request->last_id ?? 0;

    $messages = \App\Models\ChatbotMessage::where(
        'id_sessions',
        $sessionId
    )
    ->where(
        'id_messages',
        '>',
        $lastId
    )
    ->orderBy(
        'created_at',
        'asc'
    )
    ->get();

    \Log::info([
    'session_chatbot' => $sessionId,
    'last_id' => $lastId,
    'jumlah_pesan' => $messages->count(),
    'messages' => $messages->pluck('sender')
]);

    return response()->json([
        'messages' => $messages
    ]);
}
}