@extends('layouts.admin')

@section('title', 'Tulis Berita Baru')

@section('content')
<form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @include('layouts.partials.alert')
                    <div class="form-group">
                        <label for="judul">Judul Berita</label>
                        <input type="text" name="judul" id="judul" class="form-control" value="{{ old('judul') }}">
                    </div>
                    <div class="form-group">
                        <label for="konten">Isi Berita</label>
                        <textarea name="konten" id="konten" class="form-control" rows="10">{{ old('konten') }}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="kategori_id">Kategori</label>
                        <select name="kategori_id" id="kategori_id" class="form-control">
                            <option disabled selected>-- Pilih Kategori --</option>
                            @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="gambar">Gambar Utama</label>
                        <input type="file" name="gambar" id="gambar" class="form-control-file">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-block">Simpan sebagai Draft</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection