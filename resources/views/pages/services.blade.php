@extends('layouts.app')
@section('title', 'Layanan Kami')

@section('content')

<div style="background:var(--navy);padding:9rem 0 4rem;position:relative;overflow:hidden">
    <div style="position:absolute;inset:0;background-image:radial-gradient(circle at 70% 50%,rgba(201,168,76,0.07) 0%,transparent 60%)"></div>
    <div class="container" style="position:relative">
        <div class="section-label">Layanan Kami</div>
        <h1 style="font-family:var(--font-display);font-size:clamp(2rem,4vw,3.5rem);color:var(--white);margin-bottom:.75rem">Layanan Kesehatan Unggulan</h1>
        <p style="color:rgba(255,255,255,0.65);max-width:560px">Kami menyediakan berbagai layanan medis spesialistik dengan standar terbaik untuk kesehatan Anda dan keluarga.</p>
    </div>
</div>

<section style="padding:6rem 0">
    <div class="container">
        <div class="services-grid">
            @forelse($services as $service)
            <div class="service-card animate-up">
                <div class="service-icon">{{ $service->icon ?? '🏥' }}</div>
                <h3>{{ $service->name }}</h3>
                <p>{{ Str::limit($service->description, 130) }}</p>
                <a href="{{ route('services.show', $service->slug) }}" class="service-link">Selengkapnya <span>→</span></a>
            </div>
            @empty
            <div class="admin-card"><p style="color:var(--gray-400)">Layanan belum ditambahkan.</p></div>
            @endforelse
        </div>
    </div>
</section>

<section style="padding:5rem 0;background:var(--gold);text-align:center">
    <div class="container">
        <h2 style="font-family:var(--font-display);font-size:2.25rem;color:var(--navy);margin-bottom:1rem">Butuh Konsultasi?</h2>
        <p style="color:rgba(10,22,40,0.7);margin-bottom:2rem">Hubungi kami dan buat janji dengan dokter spesialis pilihan Anda.</p>
        <a href="{{ route('contact') }}" class="btn btn-navy">Buat Janji Sekarang →</a>
    </div>
</section>

@endsection

@push('scripts')
<script>
const observer = new IntersectionObserver(entries => {
    entries.forEach((entry,i) => {
        if (entry.isIntersecting) {
            setTimeout(() => entry.target.classList.add('visible'), i * 80);
            observer.unobserve(entry.target);
        }
    });
}, { threshold: 0.1 });
document.querySelectorAll('.animate-up').forEach(el => observer.observe(el));
</script>
@endpush
