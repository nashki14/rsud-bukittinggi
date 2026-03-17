@extends('layouts.app')
@section('title', 'Berita & Artikel')

@section('content')

<div style="background:var(--navy);padding:9rem 0 4rem;position:relative;overflow:hidden">
    <div style="position:absolute;inset:0;background-image:radial-gradient(circle at 70% 50%,rgba(201,168,76,0.07) 0%,transparent 60%)"></div>
    <div class="container" style="position:relative">
        <div class="section-label">Berita & Informasi</div>
        <h1 style="font-family:var(--font-display);font-size:clamp(2rem,4vw,3.5rem);color:var(--white);margin-bottom:.75rem">Berita & Artikel Kesehatan</h1>
        <p style="color:rgba(255,255,255,0.65);max-width:520px">Informasi terkini seputar kesehatan, layanan, dan kegiatan rumah sakit kami.</p>
    </div>
</div>

<section style="padding:6rem 0">
    <div class="container">
        @if($news->count())
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:1.5rem">
            @foreach($news as $article)
            <a href="{{ route('news.show', $article->slug) }}" class="news-card animate-up" style="display:block;color:inherit">
                @if($article->image)
                    <img src="{{ asset('storage/'.$article->image) }}" alt="{{ $article->title }}" class="news-card-img">
                @else
                    <div class="news-card-img" style="background:linear-gradient(135deg,#0a1628,#1d3461);display:flex;align-items:center;justify-content:center;font-size:3rem;color:rgba(201,168,76,0.4)">📰</div>
                @endif
                <div class="news-card-body">
                    <span class="news-tag">{{ $article->category ?? 'Kesehatan' }}</span>
                    <h3>{{ $article->title }}</h3>
                    <p>{{ Str::limit($article->excerpt, 100) }}</p>
                    <div class="news-meta">
                        <span>{{ $article->created_at->format('d M Y') }}</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        <div style="margin-top:2rem">{{ $news->links() }}</div>
        @else
        <div style="text-align:center;padding:4rem;color:var(--gray-400)">
            <div style="font-size:3rem;margin-bottom:1rem">📰</div>
            <p>Belum ada artikel yang dipublikasikan.</p>
        </div>
        @endif
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
