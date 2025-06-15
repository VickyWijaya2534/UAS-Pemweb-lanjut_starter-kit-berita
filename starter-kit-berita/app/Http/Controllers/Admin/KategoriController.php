<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori; // Import model Kategori
use Illuminate\Http\Request;
use Illuminate\Support\Str; // Import Str untuk membuat slug
use Illuminate\Validation\Rule; // Import Rule untuk validasi unique

class KategoriController extends Controller
{
    /**
     * Menampilkan daftar kategori.
     */
    public function index()
    {
        // Ambil semua data kategori, urutkan dari yang terbaru, dan paginasi 10 item per halaman
        $kategoris = Kategori::latest()->paginate(10);
        
        // Kirim data ke view 'admin.kategori.index'
        return view('admin.kategori.index', compact('kategoris'));
    }

    /**
     * Menampilkan form untuk membuat kategori baru.
     */
    public function create()
    {
        return view('admin.kategori.create');
    }

    /**
     * Menyimpan kategori baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategoris',
        ]);

        // Buat kategori baru
        Kategori::create([
            'nama_kategori' => $validated['nama_kategori'],
            'slug' => Str::slug($validated['nama_kategori']), // Buat slug otomatis dari nama kategori
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit kategori.
     * Route Model Binding: Laravel akan otomatis mencari Kategori berdasarkan ID.
     */
    public function edit(Kategori $kategori)
    {
        return view('admin.kategori.edit', compact('kategori'));
    }

    /**
     * Memperbarui data kategori di database.
     */
    public function update(Request $request, Kategori $kategori)
    {
        // Validasi input
        $validated = $request->validate([
            // Pastikan nama kategori unik, kecuali untuk dirinya sendiri
            'nama_kategori' => ['required', 'string', 'max:255', Rule::unique('kategoris')->ignore($kategori->id)],
        ]);

        // Update data kategori
        $kategori->update([
            'nama_kategori' => $validated['nama_kategori'],
            'slug' => Str::slug($validated['nama_kategori']),
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Menghapus data kategori dari database.
     */
    public function destroy(Kategori $kategori)
    {
        $kategori->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }
}