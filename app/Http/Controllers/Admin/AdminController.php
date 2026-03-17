<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Setting, Service, Doctor, News, Testimonial, Contact, Gallery};
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    // ── Dashboard ──────────────────────────────────────────────
    public function dashboard()
    {
        return view('admin.dashboard', [
            'doctorCount'     => Doctor::count(),
            'serviceCount'    => Service::where('is_active', 1)->count(),
            'newsCount'       => News::count(),
            'contactCount'    => Contact::where('status', 'unread')->count(),
            'recentContacts'  => Contact::latest()->take(5)->get(),
        ]);
    }

    // ── Settings ───────────────────────────────────────────────
    public function settings()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('admin.settings', compact('settings'));
    }

    public function settingsUpdate(Request $request)
    {
        $imageKeys = ['logo', 'hero_image', 'about_image'];
        $fields = $request->except(['_token', '_method'] + array_fill_keys($imageKeys, null));

        foreach ($fields as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        foreach ($imageKeys as $key) {
            if ($request->hasFile($key)) {
                $old = Setting::where('key', $key)->value('value');
                if ($old) Storage::disk('public')->delete($old);
                $path = $request->file($key)->store("settings", 'public');
                Setting::updateOrCreate(['key' => $key], ['value' => $path]);
            }
        }

        return redirect()->route('admin.settings')->with('success', 'Pengaturan berhasil disimpan.');
    }

    // ── Hero ───────────────────────────────────────────────────
    public function hero()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('admin.hero', compact('settings'));
    }

    // ── Services ───────────────────────────────────────────────
    public function servicesIndex()
    {
        return view('admin.services.index', ['services' => Service::orderBy('order')->get()]);
    }
    public function servicesCreate() { return view('admin.services.form'); }

    public function servicesStore(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:100',
            'slug'        => 'required|unique:services|max:120',
            'icon'        => 'nullable|string|max:10',
            'description' => 'nullable|string',
            'content'     => 'nullable|string',
            'order'       => 'nullable|integer',
            'is_active'   => 'required|boolean',
        ]);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('services', 'public');
        }
        Service::create($data);
        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function servicesEdit(Service $service) { return view('admin.services.form', compact('service')); }

    public function servicesUpdate(Request $request, Service $service)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:100',
            'slug'        => 'required|unique:services,slug,'.$service->id.'|max:120',
            'icon'        => 'nullable|string|max:10',
            'description' => 'nullable|string',
            'content'     => 'nullable|string',
            'order'       => 'nullable|integer',
            'is_active'   => 'required|boolean',
        ]);
        if ($request->hasFile('image')) {
            if ($service->image) Storage::disk('public')->delete($service->image);
            $data['image'] = $request->file('image')->store('services', 'public');
        }
        $service->update($data);
        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil diperbarui.');
    }

    public function servicesDestroy(Service $service)
    {
        if ($service->image) Storage::disk('public')->delete($service->image);
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil dihapus.');
    }

    // ── Doctors ────────────────────────────────────────────────
    public function doctorsIndex()
    {
        return view('admin.doctors.index', ['doctors' => Doctor::orderBy('name')->get()]);
    }
    public function doctorsCreate() { return view('admin.doctors.form'); }

    public function doctorsStore(Request $request)
    {
        $data = $request->validate([
            'name'      => 'required|string|max:150',
            'specialty' => 'required|string|max:100',
            'schedule'  => 'nullable|string|max:200',
            'education' => 'nullable|string|max:200',
            'sip'       => 'nullable|string|max:50',
            'bio'       => 'nullable|string',
            'is_active' => 'required|boolean',
        ]);
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('doctors', 'public');
        }
        Doctor::create($data);
        return redirect()->route('admin.doctors.index')->with('success', 'Data dokter berhasil ditambahkan.');
    }

    public function doctorsEdit(Doctor $doctor) { return view('admin.doctors.form', compact('doctor')); }

    public function doctorsUpdate(Request $request, Doctor $doctor)
    {
        $data = $request->validate([
            'name'      => 'required|string|max:150',
            'specialty' => 'required|string|max:100',
            'schedule'  => 'nullable|string|max:200',
            'education' => 'nullable|string|max:200',
            'sip'       => 'nullable|string|max:50',
            'bio'       => 'nullable|string',
            'is_active' => 'required|boolean',
        ]);
        if ($request->hasFile('photo')) {
            if ($doctor->photo) Storage::disk('public')->delete($doctor->photo);
            $data['photo'] = $request->file('photo')->store('doctors', 'public');
        }
        $doctor->update($data);
        return redirect()->route('admin.doctors.index')->with('success', 'Data dokter berhasil diperbarui.');
    }

    public function doctorsDestroy(Doctor $doctor)
    {
        if ($doctor->photo) Storage::disk('public')->delete($doctor->photo);
        $doctor->delete();
        return redirect()->route('admin.doctors.index')->with('success', 'Data dokter berhasil dihapus.');
    }

    // ── News ───────────────────────────────────────────────────
    public function newsIndex()
    {
        return view('admin.news.index', ['news' => News::latest()->paginate(15)]);
    }
    public function newsCreate() { return view('admin.news.form'); }

    public function newsStore(Request $request)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'category'     => 'nullable|string|max:50',
            'excerpt'      => 'nullable|string|max:300',
            'content'      => 'nullable|string',
            'is_published' => 'required|boolean',
        ]);
        $data['slug'] = Str::slug($data['title']) . '-' . time();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('news', 'public');
        }
        News::create($data);
        return redirect()->route('admin.news.index')->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function newsEdit(News $news) { return view('admin.news.form', compact('news')); }

    public function newsUpdate(Request $request, News $news)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'category'     => 'nullable|string|max:50',
            'excerpt'      => 'nullable|string|max:300',
            'content'      => 'nullable|string',
            'is_published' => 'required|boolean',
        ]);
        if ($request->hasFile('image')) {
            if ($news->image) Storage::disk('public')->delete($news->image);
            $data['image'] = $request->file('image')->store('news', 'public');
        }
        $news->update($data);
        return redirect()->route('admin.news.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function newsDestroy(News $news)
    {
        if ($news->image) Storage::disk('public')->delete($news->image);
        $news->delete();
        return redirect()->route('admin.news.index')->with('success', 'Artikel berhasil dihapus.');
    }

    // ── Testimonials ───────────────────────────────────────────
    public function testimonialsIndex()
    {
        return view('admin.testimonials.index', ['testimonials' => Testimonial::latest()->get()]);
    }
    public function testimonialsCreate() { return view('admin.testimonials.form'); }
    public function testimonialsStore(Request $request)
    {
        $data = $request->validate([
            'name'      => 'required|string|max:100',
            'role'      => 'nullable|string|max:100',
            'content'   => 'required|string|max:500',
            'rating'    => 'nullable|integer|min:1|max:5',
            'is_active' => 'required|boolean',
        ]);
        Testimonial::create($data);
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil ditambahkan.');
    }
    public function testimonialsEdit(Testimonial $testimonial) { return view('admin.testimonials.form', compact('testimonial')); }
    public function testimonialsUpdate(Request $request, Testimonial $testimonial)
    {
        $data = $request->validate([
            'name'      => 'required|string|max:100',
            'role'      => 'nullable|string|max:100',
            'content'   => 'required|string|max:500',
            'rating'    => 'nullable|integer|min:1|max:5',
            'is_active' => 'required|boolean',
        ]);
        $testimonial->update($data);
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil diperbarui.');
    }
    public function testimonialsDestroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil dihapus.');
    }

    // ── Gallery ────────────────────────────────────────────────
    public function galleryIndex()
    {
        return view('admin.gallery.index', ['galleries' => Gallery::latest()->get()]);
    }
    public function galleryStore(Request $request)
    {
        $request->validate(['images.*' => 'required|image|max:5120', 'caption' => 'nullable|string|max:200']);
        foreach ($request->file('images') as $file) {
            Gallery::create([
                'image'   => $file->store('gallery', 'public'),
                'caption' => $request->caption,
            ]);
        }
        return redirect()->route('admin.gallery.index')->with('success', 'Foto berhasil diunggah.');
    }
    public function galleryDestroy(Gallery $gallery)
    {
        Storage::disk('public')->delete($gallery->image);
        $gallery->delete();
        return redirect()->route('admin.gallery.index')->with('success', 'Foto berhasil dihapus.');
    }

    // ── Contacts ───────────────────────────────────────────────
    public function contacts()
    {
        return view('admin.contacts.index', ['contacts' => Contact::latest()->paginate(20)]);
    }
    public function contactRead(Contact $contact)
    {
        $contact->update(['status' => 'read']);
        return redirect()->back();
    }
    public function contactDestroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('admin.contacts')->with('success', 'Pesan berhasil dihapus.');
    }
}
