@extends('layouts.admin')

@section('title', 'Manajemen Berita')

@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{ route('berita.create') }}" class="btn btn-primary">Tulis Berita Baru</a>
    </div>
    <div class="card-body">
        @include('layouts.partials.alert')
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Judul</th>
                    {{-- Kolom Penulis hanya akan tampil jika yang login adalah admin --}}
                    @if(auth()->user()->level == 'admin')
                        <th>Penulis</th>
                    @endif
                    <th>Isi Berita</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($beritas as $berita)
                    <tr>
                        <td>
                            <img src="{{ asset('images/berita/'.$berita->gambar) }}" alt="Gambar Berita" width="100" class="rounded">
                        </td>
                        <td>{{ $berita->judul }}</td>
                        {{-- Nama penulis hanya akan tampil jika yang login adalah admin --}}
                        @if(auth()->user()->level == 'admin')
                            <td>{{ $berita->penulis->name }}</td>
                        @endif
                        <td>
                            {{ Str::limit(strip_tags($berita->konten), 150) }}
                        </td>
                        <td>{{ $berita->kategori->nama_kategori }}</td>
                        <td>
                            {{-- Badge status dengan warna berbeda --}}
                            @if($berita->status == 'published')
                                <span class="badge badge-success">Published</span>
                            @elseif($berita->status == 'draft')
                                <span class="badge badge-warning">Draft</span>
                            @else
                                <span class="badge badge-danger">Archived</span>
                            @endif
                        </td>
                        <td>
                            {{-- ======================================================= --}}
                            {{-- PERBAIKAN LOGIKA UTAMA ADA DI BLOK @if DI BAWAH INI --}}
                            {{-- ======================================================= --}}
                            @if(Auth::user()->level === 'admin' || Auth::id() === $berita->user_id)
                                <a href="{{ route('berita.edit', $berita->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('berita.destroy', $berita->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus berita ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            @else
                                {{-- Jika bukan admin atau pemilik, tidak ada aksi yang bisa dilakukan --}}
                                -
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        {{-- Colspan dinamis agar sesuai dengan jumlah kolom untuk setiap user --}}
                        <td colspan="{{ auth()->user()->level == 'admin' ? '7' : '6' }}" class="text-center">Anda belum menulis berita apapun.</td>
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