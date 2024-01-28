<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Doctor;
use App\Models\Galery;
use App\Models\Identity;
use App\Models\Jadwal;
use App\Models\Jumbotron;
use App\Models\Pelayanan;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $about = Identity::first();
        return view('home', [
            'name' => $about->name,
            'title' => "Home",
            'jumbotron' => Jumbotron::first(),
            'jadwal' => Jadwal::first(),
            'pelayanan' => Pelayanan::all(),
            'about' => $about,
            'dokter' => Doctor::all(),
            'post' => Post::latest()->limit(4)->get(),
        ]);
    }

    public function categories()
    {
        $about = Identity::first();
        return view('categories', [
            'name' => $about->name,
            'title' => 'Kategori Berita',
            'categories' => Category::with(['user', 'category'])->latest()->get(),
            'about' => $about,
        ]);
    }

    public function category(Category $category)
    {
        $about = Identity::first();
        return view('category', [
            'name' => $about->name,
            'title' => $category->name,
            'posts' => $category->posts,
            'about' => $about,
            'category' => $category->name,
        ]);
    }

    public function gallery()
    {
        $about = Identity::first();
        return view('gallery', [
            'name' => $about->name,
            'title' => 'Galeri',
            'about' => $about,
            'pelayanan' => Pelayanan::all(),
            'galleries' => Galery::all()
        ]);
    }

    public function dokter()
    {
        $about = Identity::first();
        return view('alldokter', [
            'name' => $about->name,
            'title' => 'Dokter',
            'dokter' => Doctor::all(),
            'about' => $about,
            'pelayanan' => Pelayanan::all(),
            'galleries' => Galery::all()
        ]);
    }

    public function jadwalDokter()
    {
        $about = Identity::first();
        return view('jadwal', [
            'name' => $about->name,
            'title' => 'Jadwal Dokter',
            'dokter' => Doctor::all(),
            'about' => $about,
            'pelayanan' => Pelayanan::all(),
            'galleries' => Galery::all()
        ]);
    }
    public function mitraKami()
    {
        $about = Identity::first();
        return view('mitra', [
            'name' => $about->name,
            'title' => 'Mirtra Kami',
            'about' => $about,
            'pelayanan' => Pelayanan::all(),
            'galleries' => Galery::all()
        ]);
    }

    public function faq()
    {
        $about = Identity::first();
        return view('faq', [
            'name' => $about->name,
            'title' => 'FAQ',
            'about' => $about,
            'pelayanan' => Pelayanan::all(),
            'galleries' => Galery::all()
        ]);
    }

    // public function igd()
    // {
    //     $about = Identity::first();
    //     return view('services.igd', [
    //         'name' => $about->name,
    //         'title' => 'IGD',
    //         'about' => $about,
    //         'pelayanan' => Pelayanan::all()
    //     ]);
    // }
}
