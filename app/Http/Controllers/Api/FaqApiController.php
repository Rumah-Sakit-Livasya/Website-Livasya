<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FaqApiController extends Controller
{
    public function getFaq()
    {
        $faqs = Faq::all();

        return response()->json($faqs);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);

        $faq = Faq::create($validatedData);

        return response()->json(['message' => 'Faq berhasil ditambahkan', 'faq' => $faq]);
    }

    public function show($faqId)
    {
        $faq = Faq::findOrFail($faqId);
        return response()->json($faq);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);

        $faq = Faq::find($id);
        $faq->update($validatedData);

        return response()->json(['message' => 'Faq berhasil diubah', 'faq' => $faq]);
    }


    public function activate($id)
    {
        try {
            $faq = Faq::findOrFail($id);
            $faq->is_active = 1;
            $faq->save();

            return response()->json(['success' => true]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['success' => false, 'message' => 'Faq not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred'], 500);
        }
    }

    public function deactivate($id)
    {
        try {
            $faq = Faq::findOrFail($id);
            $faq->is_active = 0;
            $faq->save();

            return response()->json(['success' => true]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['success' => false, 'message' => 'Faq not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred'], 500);
        }
    }
}
