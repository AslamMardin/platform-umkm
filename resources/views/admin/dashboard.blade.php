@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="stat-card">
                <i class="fas fa-folder text-primary fa-2x mb-2"></i>
                <h4 class="fw-bold text-primary">{{ $projects->count() }}</h4>
                <p class="text-muted mb-0">Total Project</p>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="stat-card">
                <i class="fas fa-images text-warning fa-2x mb-2"></i>
                <h4 class="fw-bold text-warning">{{ $templates->count() }}</h4>
                <p class="text-muted mb-0">Template Tersedia</p>
            </div>
        </div>



        <div class="col-md-3 mb-3">
            <div class="stat-card">
                <div class="price-list" style="text-align: left;">
                    <div class="price-item">
                        <span class="amount">5.000</span> / <span class="duration">1 minggu</span>
                    </div>
                    <div class="price-item">
                        <span class="amount">10.000</span> / <span class="duration">2 minggu</span>
                    </div>
                    <div class="price-item">
                        <span class="amount">15.000</span> / <span class="duration">1 bulan</span>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="stat-card">
                <img src="{{ asset('storage/img/qr-me.jpeg') }}" class="card-img-top img-fluid" alt="QR Code">
                <div class="card-body">
                    <p class="card-text" style="font-size: 9px; color:red">Scan QR code untuk pembelian paket.</p>
                </div>
            </div>
        </div>

    </div>




    @if (Auth::check() && !Auth::user()->is_premium)
        {{-- Jika BELUM premium --}}
        <div class="alert alert-warning border border-warning-subtle rounded-3 shadow-sm">
            <h5 class="mb-2"><i class="fas fa-exclamation-circle me-2"></i>Akun Anda belum Premium</h5>
            <p class="mb-3">Silakan upgrade ke akun <strong>Premium</strong> untuk membuka seluruh template dan fitur
                eksklusif.</p>

            @php
                $nama = Auth::user()->name;
                $email = Auth::user()->email;
                $pesan = "Halo, saya ingin upgrade akun ke premium.\nNama: $nama\nEmail: $email";
                $url = 'https://wa.me/6282396377878?text=' . urlencode($pesan);
            @endphp

            <a href="{{ $url }}" class="btn btn-success" target="_blank">
                <i class="fab fa-whatsapp me-1"></i> Hubungi Admin WA
            </a>
        </div>

        <div class="card mt-4 border shadow-sm">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-gem me-2"></i>Keunggulan Akun Premium</h5>
                <ul class="mb-0">
                    <li><i class="fas fa-check-circle text-success me-1"></i> Akses semua template (gratis & premium)</li>
                    <li><i class="fas fa-check-circle text-success me-1"></i> Prioritas bantuan teknis</li>
                </ul>
            </div>
        </div>
    @elseif (Auth::check() && Auth::user()->is_premium)
        {{-- Jika SUDAH premium --}}
        <div class="alert alert-success border border-success-subtle rounded-3 shadow-sm">
            <h5 class="mb-2"><i class="fas fa-check-circle me-2"></i>Akun Premium Aktif</h5>
            <p class="mb-0">Terima kasih! Akun Anda telah ditingkatkan ke <strong>Premium</strong>. Anda sekarang dapat
                menikmati seluruh fitur tanpa batas.</p>
        </div>
    @endif


@endsection

@push('styles')
    <style>
        .price-list {
            font-family: Arial, sans-serif;
            max-width: 300px;
        }

        .price-item {
            margin-bottom: 8px;
            font-size: 16px;
        }

        .amount {
            font-weight: bold;
            color: #2a9d8f;
        }

        .duration {
            color: #555;
        }
    </style>
@endpush
