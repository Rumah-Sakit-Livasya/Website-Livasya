<?php

namespace App\Http\Controllers\Pages;

use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Services\Frontend\NewsPageService;
use Illuminate\Http\Request;

class PagePostController extends Controller
{
    public function __construct(private NewsPageService $newsPageService)
    {
    }

    public function index(Request $request)
    {
        $data = $this->newsPageService->list($request->only('search'));

        if ($request->ajax()) {
            return view('partials.posts', ['posts' => $data['posts']]);
        }

        return view('posts', $data);
    }

    public function show(Post $post)
    {
        return view('post', $this->newsPageService->detail($post));
    }
}
