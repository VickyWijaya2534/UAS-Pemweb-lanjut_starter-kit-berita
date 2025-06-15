@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h3>Selamat Datang, {{ Auth::user()->name }}!</h3>
                <p>Anda login sebagai {{ Str::title(Auth::user()->level) }}.</p>
            </div>
        </div>
    </div>
</div>

{{-- TAMPILAN UNTUK ADMIN --}}
@if ($level === 'admin')
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $data['total_users'] }}</h3>
                    <p>Total Pengguna</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="{{ route('users.index') }}" class="small-box-footer">Info lebih lanjut <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $data['total_berita'] }}</h3>
                    <p>Total Berita</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{ route('berita.index') }}" class="small-box-footer">Info lebih lanjut <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $data['total_kategori'] }}</h3>
                    <p>Total Kategori</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="{{ route('kategori.index') }}" class="small-box-footer">Lihat Kategori <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
         <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $data['pending_berita'] }}</h3>
                    <p>Berita Menunggu Persetujuan</p>
                </div>
                <div class="icon">
                    <i class="ion ion-alert-circled"></i>
                </div>
                <a href="{{ route('approval.index') }}" class="small-box-footer">Lihat Daftar Approval <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
@endif

{{-- TAMPILAN UNTUK EDITOR --}}
@if ($level === 'editor')
    <div class="row">
        <div class="col-lg-6 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $data['pending_berita'] }}</h3>
                    <p>Berita Menunggu Approval</p>
                </div>
                <div class="icon">
                    <i class="fas fa-clock"></i>
                </div>
                <a href="{{ route('approval.index') }}" class="small-box-footer">Lihat Daftar Approval <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-6 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $data['published_berita'] }}</h3>
                    <p>Total Berita Diterbitkan</p>
                </div>
                <div class="icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <a href="{{ route('approval.published') }}" class="small-box-footer">Lihat Daftar Berita <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">5 Berita Terbaru Menunggu Persetujuan</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Penulis</th>
                                <th>Tgl Dibuat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data['latest_pending'] as $berita)
                                <tr>
                                    <td>{{ Str::limit($berita->judul, 50) }}</td>
                                    <td>{{ $berita->penulis->name }}</td>
                                    <td>{{ $berita->created_at->diffForHumans() }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">Tidak ada berita yang menunggu persetujuan saat ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endif


{{-- TAMPILAN UNTUK WARTAWAN --}}
@if ($level === 'wartawan')
    <div class="row">
        <div class="col-lg-4 col-6">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>{{ $data['total_berita_saya'] }}</h3>
                    <p>Total Berita Saya</p>
                </div>
                <div class="icon"><i class="fas fa-newspaper"></i></div>
                <a href="{{ route('berita.index') }}" class="small-box-footer">Lihat Semua <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-4 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $data['draft_berita_saya'] }}</h3>
                    <p>Status Draft</p>
                </div>
                <div class="icon"><i class="fas fa-file-alt"></i></div>
                <a href="{{ route('berita.index') }}" class="small-box-footer">Lihat Semua <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-4 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $data['published_berita_saya'] }}</h3>
                    <p>Status Terbit</p>
                </div>
                <div class="icon"><i class="fas fa-check"></i></div>
                <a href="{{ route('berita.index') }}" class="small-box-footer">Lihat Semua <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
     <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">5 Berita Terakhir Anda</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Status</th>
                                <th>Tgl Dibuat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data['berita_terbaru_saya'] as $berita)
                                <tr>
                                    <td>{{ Str::limit($berita->judul, 50) }}</td>
                                    <td>
                                        @if($berita->status == 'published')
                                            <span class="badge badge-success">Diterbitkan</span>
                                        @elseif($berita->status == 'draft')
                                            <span class="badge badge-warning">Draft</span>
                                        @else
                                            <span class="badge badge-danger">Ditolak/Diarsipkan</span>
                                        @endif
                                    </td>
                                    <td>{{ $berita->created_at->diffForHumans() }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">Anda belum menulis berita apapun.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endif

@endsection