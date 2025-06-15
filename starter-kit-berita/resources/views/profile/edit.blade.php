@extends('layouts.admin')

@section('title', 'Profil Saya')

@section('content')
<div class="row">
    {{-- Kita gunakan satu kolom penuh agar form memanjang ke bawah --}}
    <div class="col-md-12">

        {{-- CARD UTAMA UNTUK PROFIL DAN PASSWORD --}}
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Edit Profil dan Password</h3>
            </div>
            <div class="card-body">

                <form method="post" action="{{ route('profile.update') }}">
                    @csrf
                    @method('patch')

                    <h4>Informasi Profil</h4>
                    <p class="text-sm text-muted">
                        Update your account's profile information and email address.
                    </p>

                    @if (session('status') === 'profile-updated')
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="icon fas fa-check"></i>
                            Informasi profil berhasil disimpan.
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                        @error('name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required autocomplete="username">
                        @error('email')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Simpan Informasi</button>
                    </div>
                </form>

                {{-- Garis pemisah antar form --}}
                <hr>

                <form method="post" action="{{ route('password.update') }}" class="mt-4">
                    @csrf
                    @method('put')

                    <h4>Update Password</h4>
                     <p class="text-sm text-muted">
                        Ensure your account is using a long, random password to stay secure.
                    </p>

                    @if (session('status') === 'password-updated')
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="icon fas fa-check"></i>
                            Password berhasil diperbarui.
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="current_password">Password Saat Ini</label>
                        <input id="current_password" name="current_password" type="password" class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" autocomplete="current-password">
                        @error('current_password', 'updatePassword')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password Baru</label>
                        <input id="password" name="password" type="password" class="form-control @error('password', 'updatePassword') is-invalid @enderror" autocomplete="new-password">
                        @error('password', 'updatePassword')
                             <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Konfirmasi Password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password">
                    </div>
                    
                    <div class="form-group">
                         <button type="submit" class="btn btn-primary">Update Password</button>
                    </div>
                </form>

            </div>
        </div>

        {{-- CARD TERPISAH UNTUK HAPUS AKUN (DEMI KEAMANAN) --}}
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title">Hapus Akun</h3>
            </div>
            <div class="card-body">
                <p>Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Sebelum menghapus akun Anda, harap unduh data atau informasi apa pun yang ingin Anda simpan.</p>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirm-user-deletion">
                    Hapus Akun
                </button>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="confirm-user-deletion" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
             <form method="post" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')

                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Konfirmasi Hapus Akun</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus akun Anda? Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Silakan masukkan kata sandi Anda untuk mengonfirmasi bahwa Anda ingin menghapus akun Anda secara permanen.</p>
                    <div class="form-group">
                        <label for="password_delete">Password</label>
                        <input id="password_delete" name="password" type="password" class="form-control @error('password', 'userDeletion') is-invalid @enderror" placeholder="Password">
                         @error('password', 'userDeletion')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus Akun</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection