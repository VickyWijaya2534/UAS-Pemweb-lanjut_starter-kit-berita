<?php

namespace App\Http\Controllers\Editor;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApprovalController extends Controller
{
    /**
     * Menampilkan daftar berita yang menunggu persetujuan (status = 'draft').
     */
    public function index()
    {
        $beritas = Berita::where('status', 'draft')
            ->with(['penulis', 'kategori']) // Load relasi untuk ditampilkan di view
            ->latest()
            ->paginate(10);

        return view('editor.approval.index', compact('beritas'));
    }

    /**
     * Menampilkan detail berita untuk direview.
     */
    public function show(Berita $berita)
    {
        // Pastikan berita yang dibuka adalah draft
        if ($berita->status !== 'draft') {
            return redirect()->route('approval.index')->with('error', 'Berita ini sudah diproses.');
        }

        return view('editor.approval.show', compact('berita'));
    }

    /**
     * Menyetujui (publish) berita.
     */
    public function approve(Berita $berita)
    {
        $berita->update([
            'status' => 'published',
            'editor_id' => Auth::id(), // Catat siapa editor yang menyetujui
            'published_at' => now(),   // Catat waktu publish
        ]);

        return redirect()->route('approval.index')->with('success', 'Berita berhasil di-publish.');
    }

    /**
     * Menolak (archive) berita.
     */
    public function reject(Berita $berita)
    {
        $berita->update([
            'status' => 'archived', // Ubah status menjadi 'archived' atau 'rejected'
            'editor_id' => Auth::id(), // Catat siapa editor yang menolak
        ]);

        return redirect()->route('approval.index')->with('success', 'Berita telah ditolak/diarsipkan.');
    }

    public function publishedList()
    {
        $beritas = Berita::where('status', 'published')
            ->with(['penulis', 'kategori']) // Muat relasi untuk ditampilkan
            ->latest('published_at') // Urutkan berdasarkan tanggal terbit terbaru
            ->paginate(10);

        // Kirim data ke view baru yang akan kita buat
        return view('editor.approval.published', compact('beritas'));
    }

}