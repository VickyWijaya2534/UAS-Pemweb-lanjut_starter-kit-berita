<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth; // <-- Pastikan ini ada
use App\Models\User;                  // <-- Pastikan ini ada
use App\Models\Berita;                 // <-- Pastikan ini ada
use App\Models\Kategori;               // <-- Pastikan ini ada

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard utama yang dinamis berdasarkan role user.
     */
    public function index(): View
    {
        $level = Auth::user()->level;
        $data = [];

        if ($level === 'admin') {
            $data['total_users'] = User::count();
            $data['total_berita'] = Berita::count();
            $data['total_kategori'] = Kategori::count();
            $data['pending_berita'] = Berita::where('status', 'draft')->count();

        } elseif ($level === 'editor') {
            $data['pending_berita'] = Berita::where('status', 'draft')->count();
            $data['published_berita'] = Berita::where('status', 'published')->count();
            $data['latest_pending'] = Berita::where('status', 'draft')
                                        ->with('penulis')
                                        ->latest()
                                        ->take(5)
                                        ->get();

        } elseif ($level === 'wartawan') {
            $userId = Auth::id();
            $data['total_berita_saya'] = Berita::where('user_id', $userId)->count();
            $data['draft_berita_saya'] = Berita::where('user_id', $userId)->where('status', 'draft')->count();
            $data['published_berita_saya'] = Berita::where('user_id', $userId)->where('status', 'published')->count();
            $data['berita_terbaru_saya'] = Berita::where('user_id', $userId)
                                            ->latest()
                                            ->take(5)
                                            ->get();
        }

        // INI BAGIAN PALING PENTING YANG MEMPERBAIKI ERROR ANDA
        // Pastikan Anda mengirimkan 'data' dan 'level' ke view
        return view('dashboard', compact('data', 'level'));
    }
}