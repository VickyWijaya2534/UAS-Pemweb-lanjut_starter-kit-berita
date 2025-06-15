@extends('layouts.admin')

@section('title', 'Edit Berita')

@section('content')
{{-- Form ini akan sangat mirip dengan form 'create', tapi sudah terisi data --}}
<form action="{{ route('berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT') {{-- Method 'PUT' wajib untuk proses update --}}
    
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Formulir Edit Berita</h3>
                </div>
                <div class="card-body">
                    @include('layouts.partials.alert')
                    <div class="form-group">
                        <label for="judul">Judul Berita</label>
                        {{-- Mengisi value dengan data lama dari database --}}
                        <input type="text" name="judul" id="judul" class="form-control" value="{{ old('judul', $berita->judul) }}">
                    </div>
                    <div class="form-group">
                        <label for="konten">Isi Berita</label>
                        {{-- Mengisi textarea dengan data lama --}}
                        <textarea name="konten" id="konten" class="form-control" rows="10">{{ old('konten', $berita->konten) }}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                 <div class="card-header">
                    <h3 class="card-title">Meta Data</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="kategori_id">Kategori</label>
                        <select name="kategori_id" id="kategori_id" class="form-control">
                            <option disabled>-- Pilih Kategori --</option>
                            @foreach ($kategoris as $kategori)
                                {{-- Memberi 'selected' jika ID kategori sama dengan data lama --}}
                                <option value="{{ $kategori->id }}" {{ old('kategori_id', $berita->kategori_id) == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="gambar">Ganti Gambar Utama</label>
                        <div class="mb-2">
                            <img src="{{ asset('images/berita/'.$berita->gambar) }}" alt="Gambar saat ini" class="img-fluid rounded" width="200">
                        </div>
                        <input type="file" name="gambar" id="gambar" class="form-control-file">
                        <small class="text-muted">Kosongkan jika tidak ingin mengganti gambar.</small>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-block">Update Berita</button>
                    <a href="{{ route('berita.index') }}" class="btn btn-secondary btn-block mt-2">Batal</a>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection