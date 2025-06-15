@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Form Edit User</h3>
    </div>
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card-body">
            @include('layouts.partials.alert')
            <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $user->name) }}">
            </div>
             <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" id="email" value="{{ old('email', $user->email) }}">
            </div>
            <div class="form-group">
                <label for="level">Level</label>
                <select name="level" id="level" class="form-control">
                    <option value="admin" {{ $user->level == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="editor" {{ $user->level == 'editor' ? 'selected' : '' }}>Editor</option>
                    <option value="wartawan" {{ $user->level == 'wartawan' ? 'selected' : '' }}>Wartawan</option>
                </select>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>
@endsection