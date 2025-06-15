@extends('layouts.admin')

@section('title', 'Edit Kategori')

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Form Edit Kategori</h3>
    </div>
    <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card-body">
            @include('layouts.partials.alert')
            <div class="form-group">
                <label for="nama_kategori">Nama Kategori</label>
                <input type="text" name="nama_kategori" class="form-control" id="nama_kategori" placeholder="Masukkan Nama Kategori" value="{{ old('nama_kategori', $kategori->nama_kategori) }}">
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>
@endsection