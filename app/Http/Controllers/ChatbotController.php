<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatbotController extends Controller
{
    private function getSupabaseClient()
    {
        return Http::withHeaders([
            'apikey' => env('VITE_SUPABASE_ANON_KEY'),
            'Authorization' => 'Bearer ' . env('VITE_SUPABASE_ANON_KEY'),
        ])->baseUrl(env('VITE_SUPABASE_URL') . '/rest/v1/');
    }

    public function chat(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string',
            'session_id' => 'required|string',
        ]);

        $knowledgeResponse = $this->getSupabaseClient()
            ->get('chatbot_knowledge?status=eq.active');

        $knowledge = $knowledgeResponse->successful() ? $knowledgeResponse->json() : [];

        $botResponse = $this->generateResponse($validated['message'], $knowledge);

        $this->getSupabaseClient()->post('chatbot_conversations', [
            'session_id' => $validated['session_id'],
            'user_message' => $validated['message'],
            'bot_response' => $botResponse,
        ]);

        return response()->json([
            'response' => $botResponse,
        ]);
    }

    private function generateResponse($userMessage, $knowledge)
    {
        $userMessage = strtolower($userMessage);

        foreach ($knowledge as $item) {
            $title = strtolower($item['title']);
            $content = strtolower($item['content']);

            if (
                str_contains($userMessage, 'program') && str_contains($title, 'program') ||
                str_contains($userMessage, 'khitan') && str_contains($title, 'program') ||
                str_contains($userMessage, 'apa') && str_contains($title, 'tentang program')
            ) {
                return $item['content'];
            }

            if (
                str_contains($userMessage, 'syarat') && str_contains($title, 'syarat') ||
                str_contains($userMessage, 'persyaratan') && str_contains($title, 'persyaratan')
            ) {
                return $item['content'];
            }

            if (
                str_contains($userMessage, 'daftar') && str_contains($title, 'cara mendaftar') ||
                str_contains($userMessage, 'mendaftar') && str_contains($title, 'cara mendaftar') ||
                str_contains($userMessage, 'pendaftaran') && str_contains($title, 'cara mendaftar')
            ) {
                return $item['content'];
            }

            if (
                str_contains($userMessage, 'bazma') && str_contains($title, 'bazma')
            ) {
                return $item['content'];
            }

            if (
                str_contains($userMessage, 'pertamina') && str_contains($title, 'pertamina')
            ) {
                return $item['content'];
            }

            if (
                str_contains($userMessage, 'biaya') && str_contains($title, 'biaya') ||
                str_contains($userMessage, 'gratis') && str_contains($title, 'biaya') ||
                str_contains($userMessage, 'bayar') && str_contains($title, 'biaya')
            ) {
                return $item['content'];
            }

            if (
                str_contains($userMessage, 'konsultasi') && str_contains($title, 'konsultasi') ||
                str_contains($userMessage, 'layanan') && str_contains($title, 'layanan')
            ) {
                return $item['content'];
            }
        }

        if (str_contains($userMessage, 'halo') || str_contains($userMessage, 'hai') || str_contains($userMessage, 'hello')) {
            return 'Halo! Selamat datang di Program Khitan Gratis Bazma x Pertamina. Ada yang bisa saya bantu? Anda bisa menanyakan tentang program, persyaratan, cara mendaftar, atau informasi lainnya.';
        }

        if (str_contains($userMessage, 'terima kasih') || str_contains($userMessage, 'thanks')) {
            return 'Sama-sama! Senang bisa membantu. Jika ada pertanyaan lain, jangan ragu untuk bertanya.';
        }

        return 'Maaf, saya belum memahami pertanyaan Anda. Anda bisa menanyakan tentang:\n- Program khitan gratis\n- Persyaratan pendaftaran\n- Cara mendaftar\n- Tentang Bazma dan Pertamina\n- Biaya program\n- Layanan konsultasi\n\nAtau Anda bisa menghubungi admin untuk informasi lebih lanjut.';
    }

    public function adminIndex()
    {
        $response = $this->getSupabaseClient()
            ->get('chatbot_knowledge?order=created_at.desc');

        $knowledge = $response->successful() ? $response->json() : [];

        return view('chatbot.admin.index', compact('knowledge'));
    }

    public function create()
    {
        return view('chatbot.admin.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|string',
            'status' => 'required|in:active,inactive',
        ]);

        $response = $this->getSupabaseClient()
            ->post('chatbot_knowledge', $validated);

        if ($response->successful()) {
            return redirect()->route('admin.chatbot.index')
                ->with('success', 'Knowledge base berhasil ditambahkan');
        }

        return back()->withErrors(['error' => 'Gagal menambahkan knowledge base']);
    }

    public function edit($id)
    {
        $response = $this->getSupabaseClient()
            ->get("chatbot_knowledge?id=eq.{$id}");

        if (!$response->successful() || empty($response->json())) {
            abort(404);
        }

        $knowledge = $response->json()[0];

        return view('chatbot.admin.edit', compact('knowledge'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|string',
            'status' => 'required|in:active,inactive',
        ]);

        $validated['updated_at'] = now()->toIso8601String();

        $response = $this->getSupabaseClient()
            ->patch("chatbot_knowledge?id=eq.{$id}", $validated);

        if ($response->successful()) {
            return redirect()->route('admin.chatbot.index')
                ->with('success', 'Knowledge base berhasil diperbarui');
        }

        return back()->withErrors(['error' => 'Gagal memperbarui knowledge base']);
    }

    public function destroy($id)
    {
        $response = $this->getSupabaseClient()
            ->delete("chatbot_knowledge?id=eq.{$id}");

        if ($response->successful()) {
            return redirect()->route('admin.chatbot.index')
                ->with('success', 'Knowledge base berhasil dihapus');
        }

        return back()->withErrors(['error' => 'Gagal menghapus knowledge base']);
    }
}
