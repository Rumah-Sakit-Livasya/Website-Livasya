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
        $identity = Identity::first();
        $jumbotron = Jumbotron::first();
        $jadwal = Jadwal::first();
        $pelayanan = Pelayanan::all();
        $dokter = Doctor::all();
        $post = Post::latest()->limit(4)->get();

        return view('home', compact('identity', 'jumbotron', 'jadwal', 'pelayanan', 'dokter', 'post'), [
            'title' => "Beranda",
        ]);
    }

    public function categories()
    {
        $identity = Identity::first();
        $pelayanan = Pelayanan::all();

        return view('categories', [
            'name' => $identity->name,
            'title' => 'Kategori Berita',
            'categories' => Category::all(),
            'identity' => $identity,
            'pelayanan' => $pelayanan,
        ]);
    }

    public function category(Category $category)
    {
        $pelayanan = Pelayanan::all();
        $identity = Identity::first();

        $posts = $category->posts()
            ->filter(request(['search']))
            ->latest()
            ->paginate(9)
            ->withQueryString();

        return view('category', [
            'name' => $identity->name,
            'title' => $category->name,
            'posts' => $posts,
            'identity' => $identity,
            'category' => $category->name,
            'pelayanan' => $pelayanan
        ]);
    }


    public function gallery()
    {
        $identity = Identity::first();
        return view('gallery', [
            'name' => $identity->name,
            'title' => 'Galeri',
            'identity' => $identity,
            'pelayanan' => Pelayanan::all(),
            'galleries' => Galery::all()
        ]);
    }

    public function dokter()
    {
        $identity = Identity::first();
        return view('alldokter', [
            'name' => $identity->name,
            'title' => 'Dokter',
            'dokter' => Doctor::all(),
            'identity' => $identity,
            'pelayanan' => Pelayanan::all(),
            'galleries' => Galery::all()
        ]);
    }
    public function detailDokter(Identity $identity, Doctor $dokter)
    {
        // return $dokter;
        return view('dokter', [
            'name' => $identity->name,
            'title' => 'Dokter',
            'identity' => Identity::first(),
            'dokter' => $dokter,
            'pelayanan' => Pelayanan::all()
        ]);
    }

    public function jadwalDokter()
    {
        $identity = Identity::first();
        return view('jadwal', [
            'name' => $identity->name,
            'title' => 'Jadwal Dokter',
            'dokter' => Doctor::all(),
            'identity' => $identity,
            'pelayanan' => Pelayanan::all(),
            'galleries' => Galery::all()
        ]);
    }

    public function mitraKami()
    {
        $identity = Identity::first();
        return view('mitra', [
            'name' => $identity->name,
            'title' => 'Mirtra Kami',
            'identity' => $identity,
            'pelayanan' => Pelayanan::all(),
            'galleries' => Galery::all()
        ]);
    }

    public function kebijakanPrivasi()
    {
        $identity = Identity::first();
        return view('kebijakan-privasi', [
            'name' => $identity->name,
            'title' => 'Kebijakan Privasi',
            'identity' => $identity,
            'pelayanan' => Pelayanan::all(),
            'galleries' => Galery::all()
        ]);
    }

    public function syaratKetentuan()
    {
        $identity = Identity::first();
        return view('syarat-ketentuan', [
            'name' => $identity->name,
            'title' => 'Syarat & Ketentuan',
            'identity' => $identity,
            'pelayanan' => Pelayanan::all(),
            'galleries' => Galery::all()
        ]);
    }

    public function faq()
    {
        $identity = Identity::first();
        return view('faq', [
            'name' => $identity->name,
            'title' => 'FAQ',
            'identity' => $identity,
            'pelayanan' => Pelayanan::all(),
            'galleries' => Galery::all()
        ]);
    }

    // public function igd()
    // {
    //     $identity = Identity::first();
    //     return view('services.igd', [
    //         'name' => $identity->name,
    //         'title' => 'IGD',
    //         'identity' => $identity,
    //         'pelayanan' => Pelayanan::all()
    //     ]);
    // }
}
