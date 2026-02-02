<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Identity;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwal = Jadwal::first();
        $identity = Identity::first();
        return view('pages.jadwal.index', compact('jadwal'), [
            'title' => 'Jadwal',
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'caption' => 'required',
        ]);

        $jadwal = Jadwal::first();

        if ($request->hasFile('image')) {
            if ($jadwal->image && \Illuminate\Support\Facades\Storage::exists('public/' . $jadwal->image)) {
                \Illuminate\Support\Facades\Storage::delete('public/' . $jadwal->image);
            }
            $image = $request->file('image')->store('assets/jadwal', 'public');
            $jadwal->image = $image;
        }

        if ($request->hasFile('thumbnail')) {
            if ($jadwal->thumbnail && \Illuminate\Support\Facades\Storage::exists('public/' . $jadwal->thumbnail)) {
                \Illuminate\Support\Facades\Storage::delete('public/' . $jadwal->thumbnail);
            }
            $thumbnail = $request->file('thumbnail')->store('assets/jadwal', 'public');
            $jadwal->thumbnail = $thumbnail;
        }

        $jadwal->caption = $request->caption;
        $jadwal->save();

        return redirect()->back()->with('success', 'Jadwal berhasil diupdate');
    }
}
