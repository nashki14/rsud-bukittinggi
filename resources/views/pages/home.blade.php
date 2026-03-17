@extends('layouts.app')
@section('title', 'Beranda')

@section('content')

<!-- HERO -->
<section class="hero">
    <div class="hero-bg" style="{{ !empty($settings['hero_image']) ? 'background-image:url('.asset('storage/'.$settings['hero_image']).')' : '' }}"></div>
    <div class="hero-pattern"></div>
    <div class="container">
        <div class="hero-content">
            <div class="hero-badge">
                <span class="emergency-dot" style="width:8px;height:8px"></span>
                Terakreditasi KARS Paripurna
            </div>
            <h1>
                {!! $settings['hero_title'] ?? 'Layanan Kesehatan<br><em>Terpercaya & Terdepan</em>' !!}
            </h1>
            <p class="hero-desc">
                {{ $settings['hero_subtitle'] ?? 'Kami berkomitmen memberikan pelayanan medis berkualitas tinggi dengan teknologi modern, tenaga dokter spesialis berpengalaman, dan fasilitas lengkap untuk kesehatan Anda.' }}
            </p>
            <div class="hero-actions">
                <a href="{{ route('contact') }}" class="btn btn-primary">Buat Janji Temu →</a>
                <a href="{{ route('about') }}" class="btn btn-outline">Pelajari Lebih Lanjut</a>
            </div>
        </div>
    </div>
    <div class="hero-stats">
        <div class="container">
            <div class="stat-card">
                <span class="stat-number">{{ $settings['stat_doctors'] ?? '150+' }}</span>
                <span class="stat-label">Dokter Spesialis</span>
            </div>
            <div class="stat-card">
                <span class="stat-number">{{ $settings['stat_patients'] ?? '50K+' }}</span>
                <span class="stat-label">Pasien / Tahun</span>
            </div>
            <div class="stat-card">
                <span class="stat-number">{{ $settings['stat_years'] ?? '25+' }}</span>
                <span class="stat-label">Tahun Pengalaman</span>
            </div>
            <div class="stat-card">
                <span class="stat-number">{{ $settings['stat_satisfaction'] ?? '98%' }}</span>
                <span class="stat-label">Kepuasan Pasien</span>
            </div>
        </div>
    </div>
</section>

<!-- EMERGENCY BAR -->
<div class="emergency-bar">
    <div class="container">
        <div class="emergency-tag">
            <span class="emergency-dot"></span>
            <span style="color:rgba(255,255,255,0.7);font-size:.875rem">UGD 24 Jam</span>
        </div>
        <div class="emergency-number">{{ $settings['emergency_phone'] ?? '119' }}</div>
        <div style="color:rgba(255,255,255,0.6);font-size:.875rem">Hubungi kami kapan saja untuk keadaan darurat medis</div>
        <a href="tel:{{ $settings['emergency_phone'] ?? '119' }}" class="btn btn-primary" style="padding:.625rem 1.5rem;font-size:.875rem">Hubungi Sekarang</a>
    </div>
</div>

<!-- SERVICES -->
<section class="services-section">
    <div class="container">
        <div class="services-header">
            <div>
                <div class="section-label">Layanan Kami</div>
                <h2 class="section-title">Layanan Kesehatan<br>Unggulan</h2>
            </div>
            <div>
                <p class="section-subtitle">{{ $settings['services_desc'] ?? 'Kami menyediakan berbagai layanan medis spesialistik dengan standar internasional.' }}</p>
                <a href="{{ route('services') }}" class="btn btn-navy" style="margin-top:1rem">Semua Layanan →</a>
            </div>
        </div>

        <div class="services-grid">
            @forelse($services as $service)
            <div class="service-card animate-up">
                <div class="service-icon">{{ $service->icon ?? '🏥' }}</div>
                <h3>{{ $service->name }}</h3>
                <p>{{ Str::limit($service->description, 120) }}</p>
                <a href="{{ route('services.show', $service->slug) }}" class="service-link">
                    Selengkapnya <span>→</span>
                </a>
            </div>
            @empty
            <div class="service-card"><p style="color:var(--gray-400)">Layanan belum ditambahkan.</p></div>
            @endforelse
        </div>
    </div>
</section>

<!-- ABOUT -->
<section class="about-section">
    <div class="container">
        <div class="about-grid">
            <div class="about-image-wrap animate-up">
                @if(!empty($settings['about_image']))
                    <img src="{{ asset('storage/'.$settings['about_image']) }}" alt="Tentang Kami" class="about-img-main">
                @else
                    <div class="about-img-main" style="background:linear-gradient(135deg,#0a1628,#1d3461);display:flex;align-items:center;justify-content:center;font-size:6rem;color:rgba(201,168,76,0.4)">🏥</div>
                @endif
                <div class="about-badge-float">
                    🏆<br>Akreditasi<br>Paripurna<br>{{ date('Y') }}
                </div>
            </div>
            <div class="animate-up">
                <div class="section-label">Tentang Kami</div>
                <h2 class="section-title">{{ $settings['about_title'] ?? 'Mengutamakan Kesehatan Anda Sejak 1999' }}</h2>
                <p style="color:var(--gray-600);line-height:1.8;margin-bottom:1.25rem">
                    {{ $settings['about_text_1'] ?? 'Sejak berdiri, RS Medika Prima telah melayani masyarakat dengan dedikasi penuh. Kami percaya bahwa setiap pasien berhak mendapatkan pelayanan terbaik dengan teknologi mutakhir.' }}
                </p>
                <p style="color:var(--gray-600);line-height:1.8;margin-bottom:2rem">
                    {{ $settings['about_text_2'] ?? 'Didukung oleh lebih dari 150 dokter spesialis dan tenaga medis terlatih, kami siap memberikan diagnosa yang akurat dan penanganan yang efektif.' }}
                </p>
                <div class="about-features">
                    <div class="feature-item">
                        <div class="feature-icon">✓</div>
                        <div>
                            <h4>Dokter Berpengalaman</h4>
                            <p>Lebih dari 150 spesialis</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">✓</div>
                        <div>
                            <h4>Teknologi Modern</h4>
                            <p>Peralatan medis terkini</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">✓</div>
                        <div>
                            <h4>Layanan 24 Jam</h4>
                            <p>UGD selalu siap melayani</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">✓</div>
                        <div>
                            <h4>BPJS Kesehatan</h4>
                            <p>Menerima semua jenis BPJS</p>
                        </div>
                    </div>
                </div>
                <a href="{{ route('about') }}" class="btn btn-navy" style="margin-top:2rem">Selengkapnya Tentang Kami →</a>
            </div>
        </div>
    </div>
</section>

<!-- DOCTORS -->
<section class="doctors-section">
    <div class="container">
        <div class="section-label">Tim Medis</div>
        <div style="display:flex;justify-content:space-between;align-items:flex-end;gap:2rem;flex-wrap:wrap">
            <h2 class="section-title">Dokter Spesialis<br>Kami</h2>
            <a href="{{ route('doctors') }}" class="btn btn-primary">Lihat Semua Dokter →</a>
        </div>
        <div class="doctors-grid">
            @forelse($doctors as $doctor)
            <div class="doctor-card animate-up">
                @if(!empty($doctor->photo))
                    <img src="{{ asset('storage/'.$doctor->photo) }}" alt="{{ $doctor->name }}" class="doctor-photo">
                @else
                    <div class="doctor-photo-placeholder">👨‍⚕️</div>
                @endif
                <div class="doctor-info">
                    <h3>{{ $doctor->name }}</h3>
                    <div class="doctor-specialty">{{ $doctor->specialty }}</div>
                    <div class="doctor-schedule">📅 {{ $doctor->schedule ?? 'Senin – Jumat' }}</div>
                </div>
            </div>
            @empty
            <div style="color:rgba(255,255,255,0.4);padding:2rem">Dokter belum ditambahkan.</div>
            @endforelse
        </div>
    </div>
</section>

<!-- TESTIMONIALS -->
@if($testimonials->count())
<section class="testimonial-section">
    <div class="container">
        <div class="section-label">Testimoni</div>
        <h2 class="section-title">Apa Kata Pasien Kami</h2>
        <div class="testimonials-grid">
            @foreach($testimonials as $t)
            <div class="testimonial-card animate-up">
                <div class="stars">★★★★★</div>
                <p class="testimonial-text">"{{ $t->content }}"</p>
                <div class="testimonial-author">
                    <div class="author-avatar">{{ strtoupper(substr($t->name,0,1)) }}</div>
                    <div>
                        <div class="author-name">{{ $t->name }}</div>
                        <div class="author-type">{{ $t->role ?? 'Pasien' }}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- NEWS -->
@if($news->count())
<section class="news-section">
    <div class="container">
        <div class="section-label">Berita & Artikel</div>
        <div style="display:flex;justify-content:space-between;align-items:flex-end;gap:2rem;flex-wrap:wrap;margin-bottom:0">
            <h2 class="section-title">Informasi Terkini</h2>
            <a href="{{ route('news') }}" class="btn btn-navy">Semua Berita →</a>
        </div>
        <div class="news-grid">
            @foreach($news as $i => $article)
            <div class="news-card {{ $i === 0 ? 'featured' : '' }} animate-up">
                @if(!empty($article->image))
                    <img src="{{ asset('storage/'.$article->image) }}" alt="{{ $article->title }}" class="news-card-img">
                @else
                    <div class="news-card-img" style="background:linear-gradient(135deg,#0a1628,#1d3461);display:flex;align-items:center;justify-content:center;font-size:3rem;color:rgba(201,168,76,0.4)">📰</div>
                @endif
                <div class="news-card-body">
                    <span class="news-tag">{{ $article->category ?? 'Kesehatan' }}</span>
                    <h3>{{ $article->title }}</h3>
                    @if($i === 0)
                        <p>{{ Str::limit($article->excerpt, 140) }}</p>
                    @endif
                    <div class="news-meta">
                        <span>{{ $article->created_at->format('d M Y') }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- CTA BANNER -->
<section style="padding:5rem 0;background:var(--gold);position:relative;overflow:hidden">
    <div style="position:absolute;inset:0;background-image:radial-gradient(circle at 80% 50%,rgba(255,255,255,0.15) 0%,transparent 60%)"></div>
    <div class="container" style="text-align:center;position:relative">
        <h2 style="font-family:var(--font-display);font-size:clamp(1.75rem,3.5vw,2.75rem);color:var(--navy);margin-bottom:1rem">
            {{ $settings['cta_title'] ?? 'Jaga Kesehatan Anda Sekarang' }}
        </h2>
        <p style="color:rgba(10,22,40,0.7);max-width:480px;margin:0 auto 2rem;font-size:1.0625rem">
            {{ $settings['cta_desc'] ?? 'Konsultasikan kebutuhan medis Anda dengan dokter spesialis kami hari ini.' }}
        </p>
        <a href="{{ route('contact') }}" class="btn btn-navy">Buat Janji Sekarang →</a>
    </div>
</section>

@endsection

@push('scripts')
<script>
// Scroll animations
const observer = new IntersectionObserver(entries => {
    entries.forEach((entry, i) => {
        if (entry.isIntersecting) {
            setTimeout(() => entry.target.classList.add('visible'), i * 80);
            observer.unobserve(entry.target);
        }
    });
}, { threshold: 0.12 });
document.querySelectorAll('.animate-up').forEach(el => observer.observe(el));
</script>
@endpush
