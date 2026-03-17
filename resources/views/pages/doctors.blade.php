@extends('layouts.app')
@section('title', 'Dokter Kami')

@section('content')

<div style="background:var(--navy);padding:9rem 0 4rem;position:relative;overflow:hidden">
    <div style="position:absolute;inset:0;background-image:radial-gradient(circle at 70% 50%,rgba(201,168,76,0.07) 0%,transparent 60%)"></div>
    <div class="container" style="position:relative">
        <div class="section-label">Tim Medis</div>
        <h1 style="font-family:var(--font-display);font-size:clamp(2rem,4vw,3.5rem);color:var(--white);margin-bottom:.75rem">Dokter Spesialis Kami</h1>
        <p style="color:rgba(255,255,255,0.65);max-width:520px">Didukung oleh tenaga dokter spesialis berpengalaman dan berdedikasi tinggi untuk kesehatan Anda.</p>
    </div>
</div>

<section style="padding:6rem 0;background:var(--navy)">
    <div class="container">
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
                    @if($doctor->schedule)
                    <div class="doctor-schedule">📅 {{ $doctor->schedule }}</div>
                    @endif
                    @if($doctor->education)
                    <div style="font-size:.8rem;color:rgba(255,255,255,0.4);margin-top:.5rem">🎓 {{ $doctor->education }}</div>
                    @endif
                </div>
            </div>
            @empty
            <div style="color:rgba(255,255,255,0.4);padding:2rem;grid-column:1/-1;text-align:center">Dokter belum ditambahkan.</div>
            @endforelse
        </div>
    </div>
</section>

<section style="padding:5rem 0;background:var(--gold);text-align:center">
    <div class="container">
        <h2 style="font-family:var(--font-display);font-size:2.25rem;color:var(--navy);margin-bottom:1rem">Buat Janji dengan Dokter</h2>
        <p style="color:rgba(10,22,40,0.7);margin-bottom:2rem">Konsultasikan kondisi kesehatan Anda dengan dokter spesialis kami.</p>
        <a href="{{ route('contact') }}" class="btn btn-navy">📅 Buat Janji Sekarang →</a>
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
