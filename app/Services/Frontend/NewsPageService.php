<?php

namespace App\Services\Frontend;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Cache;

class NewsPageService
{
    public function __construct(private CommonPageDataService $commonPageData)
    {
    }

    public function categories(): array
    {
        return array_merge($this->commonPageData->navigationData(), [
            'categories' => Cache::remember('frontend.news.categories', now()->addMinutes(30), fn () => Category::all()),
            'title' => 'Kategori Berita',
        ]);
    }

    public function category(Category $category, array $filters = []): array
    {
        return array_merge($this->commonPageData->navigationData(), [
            'posts' => $category->posts()
                ->with(['category', 'user'])
                ->filter($filters)
                ->latest()
                ->paginate(9)
                ->withQueryString(),
            'category' => $category,
            'title' => $category->name,
        ]);
    }

    public function list(array $filters = []): array
    {
        return array_merge($this->commonPageData->navigationData(), [
            'posts' => Post::where('is_active', 1)
                ->with(['category', 'user'])
                ->latest()
                ->filter($filters)
                ->paginate(9)
                ->withQueryString(),
            'title' => 'Berita Terkini',
        ]);
    }

    public function detail(Post $post): array
    {
        return array_merge($this->commonPageData->navigationData(), [
            'post' => $post->loadMissing(['category', 'user']),
            'title' => $post->title,
        ]);
    }
}
