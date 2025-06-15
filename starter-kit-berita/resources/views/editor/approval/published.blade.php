@extends('layouts.admin')

@section('title', 'Daftar Berita Terbit')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar Semua Berita yang Telah Diterbitkan</h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 100px;">Gambar</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Kategori</th>
                    <th>Tanggal Terbit</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($beritas as $berita)
                    <tr>
                        <td>
                            <img src="{{ asset('images/berita/'.$berita->gambar) }}" alt="{{ Str::limit($berita->judul, 20) }}" class="img-fluid rounded">
                        </td>
                        <td>{{ $berita->judul }}</td>
                        <td>{{ $berita->penulis->name }}</td>
                        <td>{{ $berita->kategori->nama_kategori }}</td>
                        <td>
                            {{-- Format tanggal agar lebih mudah dibaca --}}
                            {{ $berita->published_at->format('d F Y, H:i') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">
                            Belum ada berita yang diterbitkan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
     <div class="card-footer clearfix">
       {{ $beritas->links() }}
    </div>
</div>
@endsection