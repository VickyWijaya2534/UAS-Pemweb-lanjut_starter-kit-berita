@extends('layouts.admin')

@section('title', 'Manajemen User')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar Pengguna</h3>
    </div>
    <div class="card-body">
        @include('layouts.partials.alert')
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Level</th>
                    <th style="width: 150px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->level == 'admin')
                                <span class="badge badge-danger">Admin</span>
                            @elseif($user->level == 'editor')
                                <span class="badge badge-warning">Editor</span>
                            @else
                                <span class="badge badge-info">Wartawan</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            {{-- Mencegah tombol hapus muncul untuk user yang sedang login --}}
                            @if(auth()->id() !== $user->id)
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada data pengguna</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer clearfix">
       {{ $users->links() }}
    </div>
</div>
@endsection