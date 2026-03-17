@extends('layouts.app')
@section('title', $service->name)

@section('content')

<div style="background:var(--navy);padding:9rem 0 4rem;position:relative;overflow:hidden">
    <div style="position:absolute;inset:0;background-image:radial-gradient(circle at 70% 50%,rgba(201,168,76,0.07) 0%,transparent 60%)"></div>
    <div class="container" style="position:relative">
        <a href="{{ route('services') }}" style="color:rgba(255,255,255,0.5);font-size:.875rem;display:inline-flex;align-items:center;gap:.5rem;margin-bottom:1.5rem">← Semua Layanan</a>
        <div style="font-size:3rem;margin-bottom:1rem">{{ $service->icon ?? '🏥' }}</div>
        <h1 style="font-family:var(--font-display);font-size:clamp(2rem,4vw,3rem);color:var(--white);margin-bottom:.75rem">{{ $service->name }}</h1>
        <p style="color:rgba(255,255,255,0.65);max-width:560px">{{ $service->description }}</p>
    </div>
</div>

<section style="padding:6rem 0">
    <div class="container" style="max-width:800px">
        @if($service->image)
        <img src="{{ asset('storage/'.$service->image) }}" alt="{{ $service->name }}" style="width:100%;height:360px;object-fit:cover;border-radius:var(--radius-xl);margin-bottom:3rem">
        @endif

        @if($service->content)
        <div style="font-size:1.0625rem;color:var(--gray-600);line-height:1.9">
            {!! $service->content !!}
        </div>
        @else
        <p style="color:var(--gray-600);line-height:1.9">{{ $service->description }}</p>
        @endif

        <div style="margin-top:3rem;padding-top:2rem;border-top:1px solid var(--gray-100);display:flex;gap:1rem">
            <a href="{{ route('contact') }}" class="btn btn-primary">📅 Buat Janji untuk Layanan Ini</a>
            <a href="{{ route('services') }}" class="btn btn-navy">← Layanan Lainnya</a>
        </div>
    </div>
</section>

@endsection
