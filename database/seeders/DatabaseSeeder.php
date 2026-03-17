<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{Setting, Service, Doctor, Testimonial};

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── Settings ──────────────────────────────────────────────────────────
        $settings = [
            'hospital_name'    => 'RSUD Bukittinggi',
            'tagline'          => 'Terdepan, Profesional, Terjangkau',
            'phone'            => '(021) 5678-9012',
            'emergency_phone'  => '119',
            'email'            => 'info@rsmedika.id',
            'address'          => 'Jl. Kesehatan No. 1, Kebayoran Baru, Jakarta Selatan 12180',
            'hours'            => "Senin – Jumat: 08.00 – 20.00\nSabtu – Minggu: 08.00 – 17.00\nUGD: 24 Jam",
            'hero_title'       => 'Layanan Kesehatan<br><em>Terpercaya & Terdepan</em>',
            'hero_subtitle'    => 'Kami berkomitmen memberikan pelayanan medis berkualitas tinggi dengan teknologi modern dan tenaga dokter spesialis berpengalaman.',
            'about_title'      => 'Mengutamakan Kesehatan Anda Sejak 1999',
            'about_text_1'     => 'Sejak berdiri tahun 1999, RS Medika Prima telah melayani lebih dari 500.000 pasien dengan dedikasi penuh. Kami percaya bahwa setiap pasien berhak mendapatkan pelayanan terbaik dengan teknologi mutakhir.',
            'about_text_2'     => 'Didukung oleh lebih dari 150 dokter spesialis dan 400 tenaga medis terlatih, kami siap memberikan diagnosa yang akurat dan penanganan yang efektif untuk setiap kondisi medis.',
            'stat_doctors'     => '150+',
            'stat_patients'    => '50K+',
            'stat_years'       => '25+',
            'stat_satisfaction'=> '98%',
            'footer_desc'      => 'Memberikan pelayanan kesehatan terbaik dengan teknologi modern dan tenaga medis profesional berpengalaman.',
            'cta_title'        => 'Jaga Kesehatan Anda Sekarang',
            'cta_desc'         => 'Konsultasikan kebutuhan medis Anda dengan dokter spesialis kami hari ini.',
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        // ── Services ──────────────────────────────────────────────────────────
        $services = [
            ['name' => 'Poli Jantung & Pembuluh Darah',  'icon' => '❤️', 'description' => 'Penanganan komprehensif untuk penyakit jantung koroner, gagal jantung, aritmia, dan hipertensi dengan teknologi kateterisasi jantung terkini.', 'order' => 1],
            ['name' => 'Poli Saraf & Neurologi',          'icon' => '🧠', 'description' => 'Diagnosis dan pengobatan gangguan sistem saraf termasuk stroke, epilepsi, migrain, dan penyakit Parkinson oleh neurolog berpengalaman.', 'order' => 2],
            ['name' => 'Poli Kandungan & Kebidanan',      'icon' => '🤱', 'description' => 'Layanan kesehatan ibu dan bayi mulai dari kehamilan, persalinan normal dan SC, hingga penanganan infertilitas.', 'order' => 3],
            ['name' => 'Poli Anak & Neonatologi',         'icon' => '👶', 'description' => 'Perawatan kesehatan anak dari bayi baru lahir hingga remaja, termasuk NICU dengan peralatan modern untuk bayi prematur.', 'order' => 4],
            ['name' => 'Poli Ortopedi & Traumatologi',    'icon' => '🦴', 'description' => 'Penanganan cedera olahraga, fraktur, kelainan tulang belakang, dan penggantian sendi lutut dan pinggul.', 'order' => 5],
            ['name' => 'Poli Onkologi',                   'icon' => '🎗️', 'description' => 'Diagnosis dan pengobatan kanker secara terpadu dengan kemoterapi, radioterapi, dan bedah onkologi.', 'order' => 6],
        ];

        foreach ($services as $s) {
            Service::updateOrCreate(
                ['slug' => \Str::slug($s['name'])],
                array_merge($s, ['is_active' => true])
            );
        }

        // ── Doctors ───────────────────────────────────────────────────────────
        $doctors = [
            ['name' => 'Dr. Ahmad Fauzi, Sp.JP',     'specialty' => 'Spesialis Jantung & Pembuluh Darah', 'schedule' => 'Senin, Rabu, Jumat — 08.00–14.00', 'education' => 'FKUI — Universitas Indonesia'],
            ['name' => 'Dr. Sari Dewi, Sp.OG',       'specialty' => 'Spesialis Kandungan & Kebidanan',     'schedule' => 'Selasa, Kamis — 09.00–16.00',    'education' => 'FK UNPAD — Universitas Padjajaran'],
            ['name' => 'Dr. Budi Santoso, Sp.A',     'specialty' => 'Spesialis Anak',                      'schedule' => 'Setiap hari — 08.00–15.00',      'education' => 'FK UGM — Universitas Gadjah Mada'],
            ['name' => 'Dr. Rina Maharani, Sp.N',    'specialty' => 'Spesialis Saraf & Neurologi',         'schedule' => 'Senin–Jumat — 10.00–17.00',      'education' => 'FKUI — Universitas Indonesia'],
        ];

        foreach ($doctors as $d) {
            Doctor::updateOrCreate(['name' => $d['name']], array_merge($d, ['is_active' => true]));
        }

        // ── Testimonials ──────────────────────────────────────────────────────
        $testimonials = [
            ['name' => 'Bapak Surya Pratama', 'role' => 'Pasien Poli Jantung',    'content' => 'Pelayanan yang sangat profesional dan ramah. Dokter spesialis jantung di sini sangat mendetail dalam menjelaskan kondisi saya. Alhamdulillah setelah perawatan intensif, kondisi saya membaik pesat.', 'rating' => 5],
            ['name' => 'Ibu Rahayu Susanti',  'role' => 'Pasien Kebidanan',       'content' => 'Saya melahirkan anak kedua di sini dan pengalaman yang luar biasa. Tim bidan dan dokter sangat supportif. Fasilitas kamar rawat juga sangat bersih dan nyaman.', 'rating' => 5],
            ['name' => 'Ibu Fitria Handayani','role' => 'Orang Tua Pasien Anak', 'content' => 'Anak saya dirawat di sini selama seminggu karena demam tinggi. Dr. Budi dan timnya sangat sabar dan teliti. Alhamdulillah anak saya cepat pulih.', 'rating' => 5],
        ];

        foreach ($testimonials as $t) {
            Testimonial::create(array_merge($t, ['is_active' => true]));
        }

        echo "✅ Seeder berhasil dijalankan!\n";
    }
}
