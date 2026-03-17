<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $settings['meta_description'] ?? 'Rumah Sakit Terpercaya' }}">
    <title>{{ $settings['hospital_name'] ?? 'RS Medika Prima' }} - @yield('title', 'Beranda')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('styles')
</head>
<body>

<!-- Navigation -->
<nav class="navbar" id="navbar">
    <div class="container">
        <a href="{{ route('home') }}" class="navbar-brand">
            @if(!empty($settings['logo']))
                <img src="{{ asset('storage/'.$settings['logo']) }}" alt="Logo" class="logo-img">
            @else
                <div class="logo-text">
                    <span class="logo-plus">✚</span>
                    <div>
                        <span class="logo-name">{{ $settings['hospital_name'] ?? 'RS Medika Prima' }}</span>
                        <span class="logo-tagline">{{ $settings['tagline'] ?? 'Kesehatan Anda, Prioritas Kami' }}</span>
                    </div>
                </div>
            @endif
        </a>

        <ul class="nav-menu">
            <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a></li>
            <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">Tentang Kami</a></li>
            <li class="dropdown">
                <a href="{{ route('services') }}" class="{{ request()->routeIs('services*') ? 'active' : '' }}">Layanan <span class="chevron">▾</span></a>
                <ul class="dropdown-menu">
                    @foreach($navServices ?? [] as $service)
                        <li><a href="{{ route('services.show', $service->slug) }}">{{ $service->name }}</a></li>
                    @endforeach
                </ul>
            </li>
            <li><a href="{{ route('doctors') }}" class="{{ request()->routeIs('doctors*') ? 'active' : '' }}">Dokter</a></li>
            <li><a href="{{ route('news') }}" class="{{ request()->routeIs('news*') ? 'active' : '' }}">Berita</a></li>
            <li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Kontak</a></li>
        </ul>

        <a href="{{ $settings['appointment_link'] ?? '#appointment' }}" class="btn-appointment">Buat Janji</a>
        <button class="hamburger" id="hamburger">
            <span></span><span></span><span></span>
        </button>
    </div>
</nav>

<!-- Main Content -->
<main>
    @yield('content')
</main>

<!-- Footer -->
<footer class="footer">
    <div class="footer-top">
        <div class="container footer-grid">
            <div class="footer-brand">
                <div class="logo-text">
                    <span class="logo-plus">✚</span>
                    <div>
                        <span class="logo-name" style="color:#fff">{{ $settings['hospital_name'] ?? 'RS Medika Prima' }}</span>
                        <span class="logo-tagline" style="color:rgba(255,255,255,0.6)">{{ $settings['tagline'] ?? 'Kesehatan Anda, Prioritas Kami' }}</span>
                    </div>
                </div>
                <p class="footer-desc">{{ $settings['footer_desc'] ?? 'Memberikan pelayanan kesehatan terbaik dengan teknologi modern dan tenaga medis profesional.' }}</p>
                <div class="social-links">
                    @if(!empty($settings['facebook'])) <a href="{{ $settings['facebook'] }}" target="_blank">f</a> @endif
                    @if(!empty($settings['instagram'])) <a href="{{ $settings['instagram'] }}" target="_blank">in</a> @endif
                    @if(!empty($settings['youtube'])) <a href="{{ $settings['youtube'] }}" target="_blank">▶</a> @endif
                </div>
            </div>
            <div class="footer-col">
                <h4>Layanan Unggulan</h4>
                <ul>
                    @foreach($footerServices ?? [] as $service)
                        <li><a href="{{ route('services.show', $service->slug) }}">{{ $service->name }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="footer-col">
                <h4>Jam Operasional</h4>
                <div class="hours-list">
                    {!! nl2br(e($settings['hours'] ?? "Senin – Jumat: 08.00 – 20.00\nSabtu – Minggu: 08.00 – 17.00\nUGD: 24 Jam")) !!}
                </div>
            </div>
            <div class="footer-col">
                <h4>Kontak</h4>
                <div class="contact-info">
                    <p>📍 {{ $settings['address'] ?? 'Jl. Kesehatan No. 1, Jakarta' }}</p>
                    <p>📞 {{ $settings['phone'] ?? '(021) 1234-5678' }}</p>
                    <p>✉ {{ $settings['email'] ?? 'info@rsmedika.id' }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <p>© {{ date('Y') }} {{ $settings['hospital_name'] ?? 'RS Medika Prima' }}. Hak cipta dilindungi.</p>
        </div>
    </div>
</footer>

<script src="{{ asset('js/app.js') }}"></script>
@stack('scripts')
</body>
</html>
