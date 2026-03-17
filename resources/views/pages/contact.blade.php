@extends('layouts.app')
@section('title', 'Kontak & Janji Temu')

@section('content')

<!-- Page Header -->
<div style="background:var(--navy);padding:9rem 0 4rem;position:relative;overflow:hidden">
    <div style="position:absolute;inset:0;background-image:radial-gradient(circle at 70% 50%,rgba(201,168,76,0.07) 0%,transparent 60%)"></div>
    <div class="container" style="position:relative">
        <div class="section-label">Hubungi Kami</div>
        <h1 style="font-family:var(--font-display);font-size:clamp(2rem,4vw,3.5rem);color:var(--white);margin-bottom:.75rem">Kontak & Buat Janji</h1>
        <p style="color:rgba(255,255,255,0.65);max-width:520px">Kami siap membantu Anda. Hubungi kami atau isi formulir untuk membuat janji temu dengan dokter spesialis kami.</p>
    </div>
</div>

<section class="contact-section">
    <div class="container">
        <div class="contact-grid">
            <div class="contact-info-block">
                <div class="section-label">Informasi</div>
                <h2>Kami Siap<br>Membantu Anda</h2>
                <p>Jangan ragu untuk menghubungi kami. Tim customer service kami siap membantu Anda 24 jam sehari.</p>

                <div class="contact-items">
                    <div class="contact-item">
                        <div class="contact-item-icon">📍</div>
                        <div class="contact-item-text">
                            <strong>Alamat</strong>
                            <span>{{ $settings['address'] ?? 'Jl. Kesehatan No. 1, Jakarta' }}</span>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-item-icon">📞</div>
                        <div class="contact-item-text">
                            <strong>Telepon</strong>
                            <span>{{ $settings['phone'] ?? '(021) 1234-5678' }}</span>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-item-icon">🚨</div>
                        <div class="contact-item-text">
                            <strong>UGD 24 Jam</strong>
                            <span style="color:var(--gold);font-size:1.25rem;font-weight:700">{{ $settings['emergency_phone'] ?? '119' }}</span>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-item-icon">✉</div>
                        <div class="contact-item-text">
                            <strong>Email</strong>
                            <span>{{ $settings['email'] ?? 'info@rsmedika.id' }}</span>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-item-icon">🕐</div>
                        <div class="contact-item-text">
                            <strong>Jam Operasional</strong>
                            <span style="white-space:pre-line">{{ $settings['hours'] ?? "Sen–Jum: 08.00–20.00\nSabtu–Min: 08.00–17.00\nUGD: 24 Jam" }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                @if(session('success'))
                <div class="alert alert-success">✓ {{ session('success') }}</div>
                @endif

                <div class="contact-form" id="appointment">
                    <h3>Form Buat Janji Temu</h3>
                    <form method="POST" action="{{ route('contact.store') }}">
                        @csrf
                        <div class="form-row">
                            <div class="form-group">
                                <label>Nama Lengkap *</label>
                                <input type="text" name="name" value="{{ old('name') }}" required placeholder="Nama Anda">
                                @error('name')<span style="color:var(--red);font-size:.8rem">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group">
                                <label>Email *</label>
                                <input type="email" name="email" value="{{ old('email') }}" required placeholder="email@anda.com">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label>Nomor HP</label>
                                <input type="text" name="phone" value="{{ old('phone') }}" placeholder="08xx-xxxx-xxxx">
                            </div>
                            <div class="form-group">
                                <label>Layanan yang Dituju</label>
                                <select name="service">
                                    <option value="">— Pilih Layanan —</option>
                                    @foreach($services as $s)
                                        <option value="{{ $s->name }}" {{ old('service') === $s->name ? 'selected' : '' }}>{{ $s->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Pesan / Keluhan *</label>
                            <textarea name="message" required placeholder="Ceritakan keluhan atau pertanyaan Anda...">{{ old('message') }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;font-size:1rem">
                            📅 Kirim & Buat Janji
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
