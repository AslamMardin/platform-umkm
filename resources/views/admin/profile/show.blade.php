@extends('layouts.app')

@section('title', 'Informasi Profil')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4">Informasi Profil</h2>

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="mb-3">
                    <strong>Nama:</strong>
                    <p>{{ Auth::user()->name }}</p>
                </div>

                <div class="mb-3">
                    <strong>Email:</strong>
                    <p>{{ Auth::user()->email }}</p>
                </div>

                <div class="mb-3">
                    <strong>Status Akun:</strong>
                    <p>
                        @if (Auth::user()->is_premium)
                            <span class="badge bg-success">Premium</span>
                        @else
                            <span class="badge bg-secondary">Gratis</span>
                        @endif
                    </p>
                </div>

                <div class="mb-3">
                    <strong>Tanggal Bergabung:</strong>
                    <p>{{ Auth::user()->created_at->translatedFormat('d F Y') }}</p>
                </div>

                <a href="{{ route('profile.edit') }}" class="btn btn-primary">
                    <i class="fas fa-edit me-1"></i> Ubah Profil
                </a>
            </div>
        </div>
    </div>
@endsection
