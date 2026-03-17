@extends('layouts.app')
@section('title', $article->title)

@section('content')

<div style="background:var(--navy);padding:9rem 0 4rem;position:relative;overflow:hidden">
    <div style="position:absolute;inset:0;background-image:radial-gradient(circle at 70% 50%,rgba(201,168,76,0.07) 0%,transparent 60%)"></div>
    <div class="container" style="position:relative;max-width:800px">
        <a href="{{ route('news') }}" style="color:rgba(255,255,255,0.5);font-size:.875rem;display:inline-flex;align-items:center;gap:.5rem;margin-bottom:1.5rem">← Semua Berita</a>
        <span class="news-tag" style="margin-bottom:1rem;display:inline-block">{{ $article->category ?? 'Kesehatan' }}</span>
        <h1 style="font-family:var(--font-display);font-size:clamp(1.75rem,4vw,3rem);color:var(--white);line-height:1.2;margin-bottom:1rem">{{ $article->title }}</h1>
        <div style="color:rgba(255,255,255,0.5);font-size:.875rem">{{ $article->created_at->format('d F Y') }}</div>
    </div>
</div>

<section style="padding:5rem 0">
    <div class="container" style="max-width:800px">
        @if($article->image)
        <img src="{{ asset('storage/'.$article->image) }}" alt="{{ $article->title }}" style="width:100%;height:400px;object-fit:cover;border-radius:var(--radius-xl);margin-bottom:3rem;box-shadow:var(--shadow-lg)">
        @endif

        @if($article->excerpt)
        <p style="font-size:1.125rem;color:var(--navy);font-weight:500;line-height:1.8;margin-bottom:2rem;padding-bottom:2rem;border-bottom:1px solid var(--gray-100)">
            {{ $article->excerpt }}
        </p>
        @endif

        <div style="font-size:1.0625rem;color:var(--gray-600);line-height:1.9">
            {!! $article->content ?? '<p>Konten artikel belum tersedia.</p>' !!}
        </div>

        <div style="margin-top:3rem;padding-top:2rem;border-top:1px solid var(--gray-100)">
            <a href="{{ route('news') }}" class="btn btn-navy">← Kembali ke Berita</a>
        </div>
    </div>
</section>

@endsection
