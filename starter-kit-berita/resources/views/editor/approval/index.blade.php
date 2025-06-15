@extends('layouts.admin')

@section('title', 'Approval Berita')

@section('content')
<div class="card">
    <div class="card-body">
        @include('layouts.partials.alert')
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Judul Berita</th>
                    <th>Penulis</th>
                    <th>Kategori</th>
                    <th>Tgl Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($beritas as $berita)
                    <tr>
                        <td>{{ $berita->judul }}</td>
                        <td>{{ $berita->penulis->name }}</td>
                        <td>{{ $berita->kategori->nama_kategori }}</td>
                        <td>{{ $berita->created_at->format('d M Y') }}</td>
                        <td>
                            <a href="{{ route('approval.show', $berita->id) }}" class="btn btn-sm btn-info">Review & Approve</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada berita yang menunggu approval.</td>
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