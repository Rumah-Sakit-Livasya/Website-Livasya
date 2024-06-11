<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Timeline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TimelineApiController extends Controller
{
    public function getTimeline()
    {
        $timelines = Timeline::all();

        return response()->json($timelines);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'flag' => 'required|max:255',
            'time' => 'required|max:255',
            'desc' => 'required',
            'image' => 'image|file',
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('img-timeline');
        }

        $timeline = Timeline::create($validatedData);

        return response()->json(['message' => 'Timeline berhasil ditambahkan', 'timeline' => $timeline]);
    }

    public function show($timelineId)
    {
        $timeline = Timeline::findOrFail($timelineId);
        return response()->json($timeline);
    }

    public function update(Request $request, $timelineId)
    {
        $timeline = Timeline::findOrFail($timelineId);
        $rules = [
            'flag' => 'required|max:255',
            'time' => 'required|max:255',
            'desc' => 'required',
            'image' => 'image|file',
        ];

        $validatedData = $request->validate($rules);

        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }

            $validatedData['image'] = $request->file('image')->store('img-timeline');
        }

        $timeline->update($validatedData);

        return response()->json(['message' => 'Timeline updated successfully']);
    }
}
