<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin — @yield('title', 'Dashboard') | {{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('styles')
</head>
<body class="admin-body">

<aside class="admin-sidebar">
    <div class="sidebar-header">
        <div class="sidebar-logo-plus">✚</div>
        <div>
            <div class="sidebar-title">{{ config('app.name', 'RS Medika Prima') }}</div>
            <div class="sidebar-subtitle">Panel Administrasi</div>
        </div>
    </div>

    <nav class="sidebar-nav">
        <div class="sidebar-section-title">Utama</div>
        <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <span class="sidebar-icon">📊</span> Dashboard
        </a>

        <div class="sidebar-section-title">Konten</div>
        <a href="{{ route('admin.settings') }}" class="sidebar-link {{ request()->routeIs('admin.settings*') ? 'active' : '' }}">
            <span class="sidebar-icon">⚙️</span> Pengaturan Umum
        </a>
        <a href="{{ route('admin.hero') }}" class="sidebar-link {{ request()->routeIs('admin.hero*') ? 'active' : '' }}">
            <span class="sidebar-icon">🖼️</span> Hero & Banner
        </a>
        <a href="{{ route('admin.services.index') }}" class="sidebar-link {{ request()->routeIs('admin.services*') ? 'active' : '' }}">
            <span class="sidebar-icon">🏥</span> Layanan
        </a>
        <a href="{{ route('admin.doctors.index') }}" class="sidebar-link {{ request()->routeIs('admin.doctors*') ? 'active' : '' }}">
            <span class="sidebar-icon">👨‍⚕️</span> Dokter
        </a>
        <a href="{{ route('admin.news.index') }}" class="sidebar-link {{ request()->routeIs('admin.news*') ? 'active' : '' }}">
            <span class="sidebar-icon">📰</span> Berita & Artikel
        </a>
        <a href="{{ route('admin.testimonials.index') }}" class="sidebar-link {{ request()->routeIs('admin.testimonials*') ? 'active' : '' }}">
            <span class="sidebar-icon">💬</span> Testimoni
        </a>
        <a href="{{ route('admin.gallery.index') }}" class="sidebar-link {{ request()->routeIs('admin.gallery*') ? 'active' : '' }}">
            <span class="sidebar-icon">🖼</span> Galeri
        </a>

        <div class="sidebar-section-title">Lainnya</div>
        <a href="{{ route('admin.contacts') }}" class="sidebar-link {{ request()->routeIs('admin.contacts*') ? 'active' : '' }}">
            <span class="sidebar-icon">📨</span> Pesan Masuk
        </a>
        <a href="{{ route('home') }}" class="sidebar-link" target="_blank">
            <span class="sidebar-icon">🌐</span> Lihat Website
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="sidebar-link" style="width:100%;background:none;border:none;cursor:pointer;text-align:left">
                <span class="sidebar-icon">🚪</span> Keluar
            </button>
        </form>
    </nav>
</aside>

<div class="admin-main">
    <div class="admin-topbar">
        <h1>@yield('title', 'Dashboard')</h1>
        <div class="admin-user">
            <span style="font-size:.875rem;color:var(--gray-600)">{{ Auth::user()->name ?? 'Administrator' }}</span>
            <div class="admin-avatar">{{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}</div>
        </div>
    </div>

    <div class="admin-content">
        @if(session('success'))
        <div class="alert alert-success">✓ {{ session('success') }}</div>
        @endif
        @if(session('error'))
        <div class="alert alert-error">✕ {{ session('error') }}</div>
        @endif

        @yield('content')
    </div>
</div>

<script src="{{ asset('js/app.js') }}"></script>
@stack('scripts')
</body>
</html>
