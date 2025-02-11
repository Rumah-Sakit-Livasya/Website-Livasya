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
        $rules = [
            'body' => 'required', // Body is required if is_embeded is checked
        ];

        // If is_embeded is not checked, make title, slug, category_id, and user_id required
        if (!$request->is_embeded) {
            $rules['title'] = 'required|max:255';
            $rules['slug'] = 'required|unique:posts';
        }

        $rules['image'] = 'image|file|max:5120'; // Image validation remains the same
        $rules['is_embeded'] = 'nullable|integer'; // Added request validation for is_embeded
        $rules['user_id'] = 'required';
        $rules['category_id'] = 'required';

        $validatedData = $request->validate($rules);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('img-berita');
        }

        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 100);

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
        $rules = [
            'body' => 'required', // Body is required if is_embeded is checked
        ];

        // If is_embeded is not checked, make title, slug, category_id, and user_id required
        if (!$request->is_embeded) {
            $rules['title'] = 'required|max:255';
            $rules['slug'] = 'required|unique:posts';
            $rules['category_id'] = 'required';
            $rules['user_id'] = 'required';
        }

        $rules['image'] = 'image|file|max:5120'; // Image validation remains the same
        $rules['is_embeded'] = 'nullable|integer'; // Added request validation for is_embeded

        if ($request->slug != $post->slug) {
            $rules['slug'] = 'required|unique:posts';
        }

        $validatedData = $request->validate($rules);

        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }

            $validatedData['image'] = $request->file('image')->store('img-berita');
        }

        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 100);

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
}
