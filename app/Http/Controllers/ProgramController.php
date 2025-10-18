<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProgramController extends Controller
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
            ->get('programs?status=eq.active&order=created_at.desc');

        $programs = $response->successful() ? $response->json() : [];

        return view('programs.index', compact('programs'));
    }

    public function show($id)
    {
        $response = $this->getSupabaseClient()
            ->get("programs?id=eq.{$id}");

        if (!$response->successful() || empty($response->json())) {
            abort(404);
        }

        $program = $response->json()[0];

        return view('programs.show', compact('program'));
    }

    public function adminIndex()
    {
        $response = $this->getSupabaseClient()
            ->get('programs?order=created_at.desc');

        $programs = $response->successful() ? $response->json() : [];

        return view('programs.admin.index', compact('programs'));
    }

    public function create()
    {
        return view('programs.admin.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'full_description' => 'required|string',
            'image_url' => 'nullable|url',
            'category' => 'required|string',
            'status' => 'required|in:active,inactive',
        ]);

        $response = $this->getSupabaseClient()
            ->post('programs', $validated);

        if ($response->successful()) {
            return redirect()->route('admin.programs.index')
                ->with('success', 'Program berhasil ditambahkan');
        }

        return back()->withErrors(['error' => 'Gagal menambahkan program']);
    }

    public function edit($id)
    {
        $response = $this->getSupabaseClient()
            ->get("programs?id=eq.{$id}");

        if (!$response->successful() || empty($response->json())) {
            abort(404);
        }

        $program = $response->json()[0];

        return view('programs.admin.edit', compact('program'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'full_description' => 'required|string',
            'image_url' => 'nullable|url',
            'category' => 'required|string',
            'status' => 'required|in:active,inactive',
        ]);

        $validated['updated_at'] = now()->toIso8601String();

        $response = $this->getSupabaseClient()
            ->patch("programs?id=eq.{$id}", $validated);

        if ($response->successful()) {
            return redirect()->route('admin.programs.index')
                ->with('success', 'Program berhasil diperbarui');
        }

        return back()->withErrors(['error' => 'Gagal memperbarui program']);
    }

    public function destroy($id)
    {
        $response = $this->getSupabaseClient()
            ->delete("programs?id=eq.{$id}");

        if ($response->successful()) {
            return redirect()->route('admin.programs.index')
                ->with('success', 'Program berhasil dihapus');
        }

        return back()->withErrors(['error' => 'Gagal menghapus program']);
    }
}
