<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PostApiController extends Controller
{
    public function getPost()
    {
        $posts = Post::all();

        return response()->json($posts);
    }

    public function store(Request $request)
    {
        // Parse Instagram code from link
        $cleanBody = trim(strip_tags($request->body));
        $code = Str::random(10);
        if (preg_match('#https?://(?:www\.)?instagram\.com/(?:p|reel|tv)/([a-zA-Z0-9_-]+)#i', $cleanBody, $matches)) {
            $code = $matches[1];
        }

        $request->merge([
            'title' => 'Instagram Post ' . $code,
            'slug' => 'instagram-post-' . strtolower($code),
            'is_embeded' => 1,
        ]);

        $rules = [
            'title' => 'required|max:255',
            'slug' => 'required|unique:posts',
            'category_id' => 'required',
            'user_id' => 'required',
            'body' => ['required', function ($attribute, $value, $fail) {
                $clean = trim(strip_tags($value));
                if (!preg_match('#https?://(?:www\.)?instagram\.com/(p|reel|tv)/([a-zA-Z0-9_-]+)#i', $clean) && strpos($value, 'instagram-media') === false) {
                    $fail('Tautan yang dimasukkan harus berupa link postingan Instagram yang valid.');
                }
            }],
            'image' => 'nullable|image|file|max:5120',
            'is_embeded' => 'nullable|integer',
        ];

        $validatedData = $request->validate($rules);
        $validatedData['is_embeded'] = 1;
        $validatedData['published_at'] = now();

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('img-berita', 'public');
        }

        $validatedData['body'] = $this->processInstagramEmbed($validatedData['body']);
        $validatedData['excerpt'] = Str::limit(strip_tags($validatedData['body']), 100);

        $post = Post::create($validatedData);

        return response()->json(['message' => 'Kategori berhasil ditambahkan', 'post' => $post]);
    }

    public function show($postId)
    {
        $post = Post::findOrFail($postId);
        // return dd($post);
        return response()->json($post);
    }

    public function update(Request $request, $postId)
    {
        $post = Post::findOrFail($postId);
        $is_embeded = $post->is_embeded;

        if ($is_embeded) {
            // Auto-generate title and slug based on new link
            $cleanBody = trim(strip_tags($request->body));
            $code = Str::random(10);
            if (preg_match('#https?://(?:www\.)?instagram\.com/(?:p|reel|tv)/([a-zA-Z0-9_-]+)#i', $cleanBody, $matches)) {
                $code = $matches[1];
            }
            $request->merge([
                'title' => 'Instagram Post ' . $code,
                'slug' => 'instagram-post-' . strtolower($code),
            ]);
        } else {
            // Keep original title and slug for legacy posts
            $request->merge([
                'title' => $post->title,
                'slug' => $post->slug,
            ]);
        }

        $rules = [
            'title' => 'required|max:255',
            'slug' => 'required|unique:posts,slug,' . $post->id,
            'category_id' => 'required',
            'user_id' => 'required',
            'image' => 'nullable|image|file|max:5120',
            'is_embeded' => 'nullable|integer',
        ];

        if ($is_embeded) {
            $rules['body'] = ['required', function ($attribute, $value, $fail) {
                $clean = trim(strip_tags($value));
                if (!preg_match('#https?://(?:www\.)?instagram\.com/(p|reel|tv)/([a-zA-Z0-9_-]+)#i', $clean) && strpos($value, 'instagram-media') === false) {
                    $fail('Tautan yang dimasukkan harus berupa link postingan Instagram yang valid.');
                }
            }];
        } else {
            $rules['body'] = 'required';
        }

        $validatedData = $request->validate($rules);
        $validatedData['is_embeded'] = $is_embeded;

        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::disk('public')->delete($request->oldImage);
            }

            $validatedData['image'] = $request->file('image')->store('img-berita', 'public');
        }

        $validatedData['body'] = $this->processInstagramEmbed($validatedData['body']);
        $validatedData['excerpt'] = Str::limit(strip_tags($validatedData['body']), 100);

        $post->update($validatedData);

        return response()->json(['message' => 'Post updated successfully']);
    }

    public function activate($id)
    {
        try {
            $post = Post::findOrFail($id);
            $post->is_active = 1;
            $post->save();

            return response()->json(['success' => true]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['success' => false, 'message' => 'Post not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred'], 500);
        }
    }

    public function deactivate($id)
    {
        try {
            $post = Post::findOrFail($id);
            $post->is_active = 0;
            $post->save();

            return response()->json(['success' => true]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['success' => false, 'message' => 'Post not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred'], 500);
        }
    }

    private function processInstagramEmbed($body)
    {
        $cleanBody = trim(strip_tags($body));
        
        if (preg_match('#https?://(?:www\.)?instagram\.com/(p|reel|tv)/([a-zA-Z0-9_-]+)#i', $cleanBody, $matches)) {
            $type = $matches[1];
            $code = $matches[2];
            $permalink = "https://www.instagram.com/{$type}/{$code}/";
            
            return '<blockquote class="instagram-media" data-instgrm-captioned data-instgrm-permalink="' . $permalink . '" data-instgrm-version="14" style="background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:540px; min-width:326px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);"><div style="padding:16px;"> <a href="' . $permalink . '" style=" background:#FFFFFF; line-height:0; padding:0 0; text-align:center; text-decoration:none; width:100%;" target="_blank"></a></div></blockquote> <script async src="https://www.instagram.com/embed.js"></script>';
        }
        
        return $body;
    }
}
