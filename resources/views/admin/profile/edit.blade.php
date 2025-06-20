@extends('layouts.app')

@section('title', 'Edit Profil')

@section('content')
    <div class="container py-4">
        <h2>Edit Profil</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control" id="name" name="name"
                    value="{{ old('name', Auth::user()->name) }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Alamat Email</label>
                <input type="email" class="form-control" id="email" name="email"
                    value="{{ old('email', Auth::user()->email) }}" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password (opsional)</label>
                <input type="password" class="form-control" id="password" name="password"
                    placeholder="Kosongkan jika tidak ingin mengganti">
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
@endsection
