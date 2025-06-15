@extends('layouts.admin')

@section('title', 'Review Berita')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h1>{{ $berita->judul }}</h1>
                <p class="text-muted">
                    Oleh: {{ $berita->penulis->name }} | Kategori: {{ $berita->kategori->nama_kategori }} | Dibuat pada: {{ $berita->created_at->format('d M Y H:i') }}
                </p>
                <hr>
                <img src="{{  asset('images/berita/'.$berita->gambar)  }}" class="img-fluid rounded mb-3" alt="{{ $berita->judul }}">
                
                <div>
                    {!! $berita->konten !!}
                </div>
                <hr>
                
                <div class="mt-4">
                    <h4>Aksi Persetujuan</h4>
                    <div class="btn-group">
                        <form action="{{ route('approval.approve', $berita->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-success">Setujui & Terbitkan</button>
                        </form>
                        
                        <form action="{{ route('approval.reject', $berita->id) }}" method="POST" class="d-inline ml-2">
                            @csrf
                            <button type="submit" class="btn btn-danger">Tolak</button>
                        </form>

                        <a href="{{ route('approval.index') }}" class="btn btn-secondary ml-2">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection