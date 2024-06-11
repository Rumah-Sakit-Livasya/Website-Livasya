<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Timeline;
use Illuminate\Http\Request;

class TimelineController extends Controller
{
    public function index()
    {
        $timelines = Timeline::all();

        return view('pages.timeline.index', compact('timelines'), [
            'title' => 'Timeline',
        ]);
    }
}
