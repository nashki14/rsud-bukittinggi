@extends('layouts.admin')
@section('title', 'Galeri Foto')

@section('content')

<div style="display:grid;grid-template-columns:1fr 2fr;gap:1.5rem;align-items:start">

    {{-- Upload Form --}}
    <div class="admin-card">
        <div class="admin-card-header">
            <h2>📤 Upload Foto</h2>
        </div>
        <form method="POST" action="{{ route('admin.gallery.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="admin-form-group">
                <label>Pilih Foto</label>
                <input type="file" name="images[]" accept="image/*" multiple required>
                <div class="form-hint">Bisa pilih lebih dari satu foto sekaligus. Maks 5MB per foto.</div>
            </div>
            <div class="admin-form-group">
                <label>Keterangan (opsional)</label>
                <input type="text" name="caption" placeholder="Contoh: Ruang Operasi Lantai 2">
            </div>
            <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center">
                📤 Upload Foto
            </button>
        </form>
    </div>

    {{-- Gallery Grid --}}
    <div class="admin-card">
        <div class="admin-card-header">
            <h2>🖼 Semua Foto ({{ $galleries->count() }})</h2>
        </div>
        @if($galleries->count())
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(150px,1fr));gap:.75rem">
            @foreach($galleries as $gallery)
            <div style="position:relative;group">
                <img src="{{ asset('storage/'.$gallery->image) }}"
                     alt="{{ $gallery->caption }}"
                     style="width:100%;height:130px;object-fit:cover;border-radius:var(--radius-sm);border:2px solid var(--gray-100)">
                @if($gallery->caption)
                <div style="font-size:.75rem;color:var(--gray-600);margin-top:.375rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">
                    {{ $gallery->caption }}
                </div>
                @endif
                <form method="POST" action="{{ route('admin.gallery.destroy', $gallery) }}"
                      onsubmit="return confirm('Hapus foto ini?')"
                      style="position:absolute;top:.375rem;right:.375rem">
                    @csrf @method('DELETE')
                    <button type="submit"
                            style="width:24px;height:24px;background:rgba(192,57,43,0.9);color:#fff;border:none;border-radius:50%;cursor:pointer;font-size:.75rem;display:flex;align-items:center;justify-content:center;line-height:1">
                        ✕
                    </button>
                </form>
            </div>
            @endforeach
        </div>
        @else
        <div style="text-align:center;padding:3rem;color:var(--gray-400)">
            <div style="font-size:3rem;margin-bottom:.75rem">🖼</div>
            <p>Belum ada foto di galeri.</p>
        </div>
        @endif
    </div>

</div>
@endsection
