<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Doctor;
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
        $jumbotron = Jumbotron::first();
        $jadwal = Jadwal::first();
        $pelayanan = Pelayanan::all();
        $dokter = Doctor::all();
        $polikliniks = Poliklinik::all();
        $post = Post::where('is_active', 1)->latest()->limit(4)->get();

        return view('home', compact('identity', 'jumbotron', 'jadwal', 'pelayanan', 'dokter', 'post', 'polikliniks'), [
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
        $customOrder = [
            'Dokter Spesialis Obgyn',
            'Dokter Spesialis Anak',
            'Dokter Spesialis Penyakit Dalam',
            'Dokter Spesialis Bedah',
            'Dokter Spesialis THT - KL',
            'Dokter Spesialis Radiologi',
            'Dokter Spesialis Anastesi',
            'Dokter Umum',
        ];

        $dokters = Doctor::all()->groupBy('jabatan');

        // Sort the grouped doctors according to the custom order
        $sortedDokters = collect($customOrder)->mapWithKeys(function ($jabatan) use ($dokters) {
            return [$jabatan => $dokters->get($jabatan, collect())];
        });

        $identity = Identity::first();
        return view('alldokter', [
            'name' => $identity->name,
            'title' => 'Dokter',
            'sortedDokters' => $sortedDokters,
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
        $mirtas = Mitra::all();

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
}
