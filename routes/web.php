<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminController;

// ── Public Routes ────────────────────────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang-kami', [HomeController::class, 'about'])->name('about');
Route::get('/layanan', [HomeController::class, 'services'])->name('services');
Route::get('/layanan/{slug}', [HomeController::class, 'serviceShow'])->name('services.show');
Route::get('/dokter', [HomeController::class, 'doctors'])->name('doctors');
Route::get('/berita', [HomeController::class, 'news'])->name('news');
Route::get('/berita/{slug}', [HomeController::class, 'newsShow'])->name('news.show');
Route::get('/kontak', [HomeController::class, 'contact'])->name('contact');
Route::post('/kontak', [HomeController::class, 'contactStore'])->name('contact.store');

// ── Auth Routes ──────────────────────────────────────────────────────────────
Auth::routes(['register' => false]);

// ── Admin Routes ─────────────────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {

    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

    // Settings
    Route::get('/pengaturan', [AdminController::class, 'settings'])->name('settings');
    Route::put('/pengaturan', [AdminController::class, 'settingsUpdate'])->name('settings.update');
    Route::get('/hero', [AdminController::class, 'hero'])->name('hero');

    // Services
    Route::get('/layanan', [AdminController::class, 'servicesIndex'])->name('services.index');
    Route::get('/layanan/buat', [AdminController::class, 'servicesCreate'])->name('services.create');
    Route::post('/layanan', [AdminController::class, 'servicesStore'])->name('services.store');
    Route::get('/layanan/{service}/edit', [AdminController::class, 'servicesEdit'])->name('services.edit');
    Route::put('/layanan/{service}', [AdminController::class, 'servicesUpdate'])->name('services.update');
    Route::delete('/layanan/{service}', [AdminController::class, 'servicesDestroy'])->name('services.destroy');

    // Doctors
    Route::get('/dokter', [AdminController::class, 'doctorsIndex'])->name('doctors.index');
    Route::get('/dokter/buat', [AdminController::class, 'doctorsCreate'])->name('doctors.create');
    Route::post('/dokter', [AdminController::class, 'doctorsStore'])->name('doctors.store');
    Route::get('/dokter/{doctor}/edit', [AdminController::class, 'doctorsEdit'])->name('doctors.edit');
    Route::put('/dokter/{doctor}', [AdminController::class, 'doctorsUpdate'])->name('doctors.update');
    Route::delete('/dokter/{doctor}', [AdminController::class, 'doctorsDestroy'])->name('doctors.destroy');

    // News
    Route::get('/berita', [AdminController::class, 'newsIndex'])->name('news.index');
    Route::get('/berita/buat', [AdminController::class, 'newsCreate'])->name('news.create');
    Route::post('/berita', [AdminController::class, 'newsStore'])->name('news.store');
    Route::get('/berita/{news}/edit', [AdminController::class, 'newsEdit'])->name('news.edit');
    Route::put('/berita/{news}', [AdminController::class, 'newsUpdate'])->name('news.update');
    Route::delete('/berita/{news}', [AdminController::class, 'newsDestroy'])->name('news.destroy');

    // Testimonials
    Route::get('/testimoni', [AdminController::class, 'testimonialsIndex'])->name('testimonials.index');
    Route::get('/testimoni/buat', [AdminController::class, 'testimonialsCreate'])->name('testimonials.create');
    Route::post('/testimoni', [AdminController::class, 'testimonialsStore'])->name('testimonials.store');
    Route::get('/testimoni/{testimonial}/edit', [AdminController::class, 'testimonialsEdit'])->name('testimonials.edit');
    Route::put('/testimoni/{testimonial}', [AdminController::class, 'testimonialsUpdate'])->name('testimonials.update');
    Route::delete('/testimoni/{testimonial}', [AdminController::class, 'testimonialsDestroy'])->name('testimonials.destroy');

    // Gallery
    Route::get('/galeri', [AdminController::class, 'galleryIndex'])->name('gallery.index');
    Route::post('/galeri', [AdminController::class, 'galleryStore'])->name('gallery.store');
    Route::delete('/galeri/{gallery}', [AdminController::class, 'galleryDestroy'])->name('gallery.destroy');

    // Contacts
    Route::get('/pesan', [AdminController::class, 'contacts'])->name('contacts');
    Route::patch('/pesan/{contact}/baca', [AdminController::class, 'contactRead'])->name('contacts.read');
    Route::delete('/pesan/{contact}', [AdminController::class, 'contactDestroy'])->name('contacts.destroy');
});
