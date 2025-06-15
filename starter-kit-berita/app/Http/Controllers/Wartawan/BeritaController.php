<?php

namespace App\Http\Controllers\Wartawan;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function index()
    {
        if (Auth::user()->level === 'admin') {
            $beritas = Berita::with('kategori', 'penulis')->latest()->paginate(10);
        } else {
            $beritas = Berita::where('user_id', Auth::id())->with('kategori')->latest()->paginate(10);
        }
        return view('wartawan.berita.index', compact('beritas'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('wartawan.berita.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'konten' => 'required|string',
        ]);

        $imageName = time() . '.' . $request->gambar->extension();
        
        $request->gambar->storeAs('', $imageName, 'public_images');

        Berita::create([
            'judul' => $validated['judul'],
            'slug' => Str::slug($validated['judul']),
            'kategori_id' => $validated['kategori_id'],
            'konten' => $validated['konten'],
            'gambar' => $imageName,
            'user_id' => Auth::id(),
            'status' => 'draft',
        ]);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil disimpan sebagai draft.');
    }

    public function edit(Berita $berita)
    {
        // Cek perizinan
        if (Auth::user()->level != 'admin' && $berita->user_id != Auth::id()) {
            abort(403, 'ANDA TIDAK MEMILIKI AKSES');
        }

        // Ambil semua data kategori untuk dropdown
        $kategoris = Kategori::all();

        // Kirim data berita dan kategori ke view
        return view('wartawan.berita.edit', compact('berita', 'kategoris'));
    }

    public function update(Request $request, Berita $berita)
    {
        // Cek perizinan
        if (Auth::user()->level != 'admin' && $berita->user_id != Auth::id()) {
            abort(403, 'ANDA TIDAK MEMILIKI AKSES');
        }

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'konten' => 'required|string',
        ]);

        $dataToUpdate = $validated;
        $dataToUpdate['slug'] = Str::slug($validated['judul']);

        if ($request->hasFile('gambar')) {
            Storage::disk('public_images')->delete($berita->gambar);
            $imageName = time() . '.' . $request->gambar->extension();
            $request->gambar->storeAs('', $imageName, 'public_images');
            $dataToUpdate['gambar'] = $imageName;
        }

        $berita->update($dataToUpdate);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(Berita $berita)
    {
        // Cek perizinan
        if (Auth::user()->level != 'admin' && $berita->user_id != Auth::id()) {
            abort(403, 'ANDA TIDAK MEMILIKI AKSES');
        }
        
        Storage::disk('public_images')->delete($berita->gambar);
        
        $berita->delete();

        return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus.');
    }
}