<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Identity;
use App\Models\Post;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;


class PostController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $posts = Post::orderBy('created_at', 'desc')->get();

        return view('pages.posts.index', compact('categories', 'posts'), [
            'title' => 'Berita',
        ]);
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
