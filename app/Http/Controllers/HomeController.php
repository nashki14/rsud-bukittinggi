<?php
// app/Http/Controllers/HomeController.php
namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Doctor;
use App\Models\News;
use App\Models\Testimonial;
use App\Models\Setting;

class HomeController extends Controller
{
    private function getSettings(): array
    {
        return Setting::pluck('value', 'key')->toArray();
    }

    public function index()
    {
        $settings     = $this->getSettings();
        $services     = Service::where('is_active', 1)->orderBy('order')->take(6)->get();
        $doctors      = Doctor::where('is_active', 1)->take(4)->get();
        $news         = News::where('is_published', 1)->latest()->take(3)->get();
        $testimonials = Testimonial::where('is_active', 1)->take(3)->get();
        $navServices  = Service::where('is_active', 1)->orderBy('order')->take(8)->get();
        $footerServices = Service::where('is_active', 1)->orderBy('order')->take(5)->get();

        return view('pages.home', compact(
            'settings', 'services', 'doctors', 'news', 'testimonials', 'navServices', 'footerServices'
        ));
    }

    public function about()
    {
        $settings = $this->getSettings();
        $navServices = Service::where('is_active', 1)->orderBy('order')->take(8)->get();
        $footerServices = Service::where('is_active', 1)->orderBy('order')->take(5)->get();
        return view('pages.about', compact('settings', 'navServices', 'footerServices'));
    }

    public function services()
    {
        $settings = $this->getSettings();
        $services = Service::where('is_active', 1)->orderBy('order')->get();
        $navServices = $services->take(8);
        $footerServices = $services->take(5);
        return view('pages.services', compact('settings', 'services', 'navServices', 'footerServices'));
    }

    public function serviceShow($slug)
    {
        $settings = $this->getSettings();
        $service = Service::where('slug', $slug)->where('is_active', 1)->firstOrFail();
        $navServices = Service::where('is_active', 1)->orderBy('order')->take(8)->get();
        $footerServices = Service::where('is_active', 1)->orderBy('order')->take(5)->get();
        return view('pages.service-detail', compact('settings', 'service', 'navServices', 'footerServices'));
    }

    public function doctors()
    {
        $settings = $this->getSettings();
        $doctors = Doctor::where('is_active', 1)->get();
        $navServices = Service::where('is_active', 1)->orderBy('order')->take(8)->get();
        $footerServices = Service::where('is_active', 1)->orderBy('order')->take(5)->get();
        return view('pages.doctors', compact('settings', 'doctors', 'navServices', 'footerServices'));
    }

    public function news()
    {
        $settings = $this->getSettings();
        $news = News::where('is_published', 1)->latest()->paginate(9);
        $navServices = Service::where('is_active', 1)->orderBy('order')->take(8)->get();
        $footerServices = Service::where('is_active', 1)->orderBy('order')->take(5)->get();
        return view('pages.news', compact('settings', 'news', 'navServices', 'footerServices'));
    }

    public function newsShow($slug)
    {
        $settings = $this->getSettings();
        $article = News::where('slug', $slug)->where('is_published', 1)->firstOrFail();
        $navServices = Service::where('is_active', 1)->orderBy('order')->take(8)->get();
        $footerServices = Service::where('is_active', 1)->orderBy('order')->take(5)->get();
        return view('pages.news-detail', compact('settings', 'article', 'navServices', 'footerServices'));
    }

    public function contact()
    {
        $settings = $this->getSettings();
        $services = Service::where('is_active', 1)->orderBy('order')->get();
        $navServices = $services->take(8);
        $footerServices = $services->take(5);
        return view('pages.contact', compact('settings', 'services', 'navServices', 'footerServices'));
    }

    public function contactStore(\Illuminate\Http\Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email',
            'phone'   => 'nullable|string|max:20',
            'service' => 'nullable|string|max:100',
            'message' => 'required|string|max:2000',
        ]);
        \App\Models\Contact::create($data);
        return back()->with('success', 'Pesan Anda telah terkirim. Kami akan segera menghubungi Anda.');
    }
}
