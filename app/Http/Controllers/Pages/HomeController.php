<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Doctor;
use App\Models\Faq;
use App\Models\Galery;
use App\Models\Identity;
use App\Models\Jadwal;
use App\Models\Jumbotron;
use App\Models\Mitra;
use App\Models\Pelayanan;
use App\Models\Poliklinik;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $identity = Identity::first();
        $pelayanan = Pelayanan::all();
        $mitras = Mitra::where('is_primary', 1)->get();

        $jumbotron = Jumbotron::first();
        $jadwal = Jadwal::first();
        $dokter = Doctor::all();
        $polikliniks = Poliklinik::all();
        $post = Post::where('is_active', 1)->latest()->limit(4)->get();

        return view('home', compact('identity', 'mitras', 'pelayanan', 'jumbotron', 'jadwal', 'dokter', 'post', 'polikliniks'), [
            'title' => "Beranda",
        ]);
    }

    public function categories()
    {
        $identity = Identity::first();
        $pelayanan = Pelayanan::all();
        $mitras = Mitra::where('is_primary', 1)->get();

        $categories = Category::all();

        return view('categories', compact('identity', 'pelayanan', 'mitras', 'categories'), [
            'title' => "Kategori Berita",
        ]);
    }

    public function category(Category $category)
    {
        $identity = Identity::first();
        $pelayanan = Pelayanan::all();
        $mitras = Mitra::where('is_primary', 1)->get();

        $posts = $category->posts()
            ->filter(request(['search']))
            ->latest()
            ->paginate(9)
            ->withQueryString();

        return view('category', compact('identity', 'pelayanan', 'mitras', 'posts', 'category'), [
            'title' => $category->name,
        ]);
    }


    public function gallery()
    {
        $identity = Identity::first();
        $pelayanan = Pelayanan::all();
        $mitras = Mitra::where('is_primary', 1)->get();

        $galleries = Galery::all();

        return view('gallery', compact('identity', 'pelayanan', 'mitras', 'galleries'), [
            'title' => 'Galeri',
        ]);
    }

    public function dokter()
    {
        $identity = Identity::first();
        $pelayanan = Pelayanan::all();
        $mitras = Mitra::where('is_primary', 1)->get();

        // Mengurutkan berdasarkan urutan di tabel departement
        $dokters = Doctor::with('departement')
            ->join('departements', 'doctors.departement_id', '=', 'departements.id')
            ->orderByRaw('CAST(departements.urutan AS UNSIGNED)') // Mengurutkan secara numerik
            ->select('doctors.*') // memastikan hanya kolom dari tabel doctors yang diambil
            ->get();

        return view('alldokter', compact('identity', 'pelayanan', 'mitras', 'dokters'), [
            'title' => 'Dokter',
        ]);
    }



    public function detailDokter(Identity $identity, Doctor $dokter)
    {
        $identity = Identity::first();
        $pelayanan = Pelayanan::all();
        $mitras = Mitra::where('is_primary', 1)->get();

        return view('dokter', compact('identity', 'pelayanan', 'mitras', 'dokter'), [
            'title' => 'Dokter',
        ]);
    }

    public function jadwalDokter()
    {
        $identity = Identity::first();
        $pelayanan = Pelayanan::all();
        $mitras = Mitra::where('is_primary', 1)->get();

        $dokter = Doctor::all();

        return view('jadwal', compact('identity', 'pelayanan', 'mitras', 'dokter'), [
            'title' => 'Jadwal Dokter',
        ]);
    }

    public function mitraKami()
    {
        $identity = Identity::first();
        $pelayanan = Pelayanan::all();
        $mitras = Mitra::where('is_primary', 1)->get();

        $mitraPage = Mitra::all();

        return view('mitra', compact('identity', 'pelayanan', 'mitras', 'mitraPage'), [
            'title' => 'Mitra Kami',
        ]);
    }

    public function kebijakanPrivasi()
    {
        $identity = Identity::first();
        $pelayanan = Pelayanan::all();
        $mitras = Mitra::where('is_primary', 1)->get();

        return view('kebijakan-privasi', compact('identity', 'pelayanan', 'mitras'), [
            'title' => 'Kebijakan Privasi',
        ]);
    }

    public function syaratKetentuan()
    {
        $identity = Identity::first();
        $pelayanan = Pelayanan::all();
        $mitras = Mitra::where('is_primary', 1)->get();

        return view('syarat-ketentuan', compact('identity', 'pelayanan', 'mitras'), [
            'title' => 'Syarat & Ketentuan',
        ]);
    }

    public function faq()
    {
        $identity = Identity::first();
        $pelayanan = Pelayanan::all();
        $mitras = Mitra::where('is_primary', 1)->get();

        $faqs = Faq::where('is_active', 1)->get();

        return view('faq', compact('identity', 'pelayanan', 'mitras', 'faqs'), [
            'title' => 'FAQ',
        ]);
    }
}
