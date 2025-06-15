@extends('layouts.admin')

@section('title', 'Tambah Kategori')

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Form Tambah Kategori</h3>
    </div>
    <form action="{{ route('kategori.store') }}" method="POST">
        @csrf
        <div class="card-body">
            @include('layouts.partials.alert')
            <div class="form-group">
                <label for="nama_kategori">Nama Kategori</label>
                <input type="text" name="nama_kategori" class="form-control" id="nama_kategori" placeholder="Masukkan Nama Kategori" value="{{ old('nama_kategori') }}">
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>
@endsection