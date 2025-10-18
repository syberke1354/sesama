<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DonationController extends Controller
{
    private function getSupabaseClient()
    {
        return Http::withHeaders([
            'apikey' => env('VITE_SUPABASE_ANON_KEY'),
            'Authorization' => 'Bearer ' . env('VITE_SUPABASE_ANON_KEY'),
        ])->baseUrl(env('VITE_SUPABASE_URL') . '/rest/v1/');
    }

    public function index()
    {
        $response = $this->getSupabaseClient()
            ->get('donations?status=eq.active&order=created_at.desc');

        $donations = $response->successful() ? $response->json() : [];

        return view('donations.index', compact('donations'));
    }

    public function show($id)
    {
        $response = $this->getSupabaseClient()
            ->get("donations?id=eq.{$id}");

        if (!$response->successful() || empty($response->json())) {
            abort(404);
        }

        $donation = $response->json()[0];

        return view('donations.show', compact('donation'));
    }

    public function adminIndex()
    {
        $response = $this->getSupabaseClient()
            ->get('donations?order=created_at.desc');

        $donations = $response->successful() ? $response->json() : [];

        return view('donations.admin.index', compact('donations'));
    }

    public function create()
    {
        return view('donations.admin.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'full_description' => 'required|string',
            'image_url' => 'nullable|url',
            'whatsapp_number' => 'required|string',
            'whatsapp_message' => 'required|string',
            'status' => 'required|in:active,inactive',
        ]);

        $response = $this->getSupabaseClient()
            ->post('donations', $validated);

        if ($response->successful()) {
            return redirect()->route('admin.donations.index')
                ->with('success', 'Donasi berhasil ditambahkan');
        }

        return back()->withErrors(['error' => 'Gagal menambahkan donasi']);
    }

    public function edit($id)
    {
        $response = $this->getSupabaseClient()
            ->get("donations?id=eq.{$id}");

        if (!$response->successful() || empty($response->json())) {
            abort(404);
        }

        $donation = $response->json()[0];

        return view('donations.admin.edit', compact('donation'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'full_description' => 'required|string',
            'image_url' => 'nullable|url',
            'whatsapp_number' => 'required|string',
            'whatsapp_message' => 'required|string',
            'status' => 'required|in:active,inactive',
        ]);

        $validated['updated_at'] = now()->toIso8601String();

        $response = $this->getSupabaseClient()
            ->patch("donations?id=eq.{$id}", $validated);

        if ($response->successful()) {
            return redirect()->route('admin.donations.index')
                ->with('success', 'Donasi berhasil diperbarui');
        }

        return back()->withErrors(['error' => 'Gagal memperbarui donasi']);
    }

    public function destroy($id)
    {
        $response = $this->getSupabaseClient()
            ->delete("donations?id=eq.{$id}");

        if ($response->successful()) {
            return redirect()->route('admin.donations.index')
                ->with('success', 'Donasi berhasil dihapus');
        }

        return back()->withErrors(['error' => 'Gagal menghapus donasi']);
    }
}
