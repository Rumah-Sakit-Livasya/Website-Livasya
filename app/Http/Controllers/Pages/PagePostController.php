<?php

namespace App\Http\Controllers\Pages;

use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Models\Identity;
use App\Models\Mitra;
use App\Models\Pelayanan;

class PagePostController extends Controller
{
    public function index()
    {
        $identity = Identity::first();
        $pelayanan = Pelayanan::all();
        $mitras = Mitra::where('is_primary', 1)->get();

        $posts = Post::where('is_active', 1)->latest()->filter(request(['search']))->paginate(9)->withQueryString();

        return view('posts', compact('identity', 'pelayanan', 'mitras', 'posts'), [
            'title' => 'Berita Terkini',
        ]);
    }

    public function show(Post $post)
    {
        $identity = Identity::first();
        $pelayanan = Pelayanan::all();
        $mitras = Mitra::where('is_primary', 1)->get();

        return view('post', compact('identity', 'pelayanan', 'mitras', 'post'), [
            'title' => $post->title,
        ]);
    }
}
