<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Identity;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $identity = Identity::first();

        return view('pages.user.index', compact('identity', 'users'), [
            'title' => "Pengguna"
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        $validatedData['password'] = Hash::make($request['password']);

        User::create($validatedData);
        return back()->with('success', 'User dibuat!');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        User::where('id', $id)->update($validatedData);
        return back()->with('success', 'User berhasil diperbarui!');
    }

    public function akses(Request $request, User $user)
    {
        // return $user;
        $validatedData = $request->validate([
            'role' => 'max:255',
        ]);

        User::where('id', $user->id)->update($validatedData);
        return back()->with('success', 'User Akses berhasil diubah!');
    }

    public function updatePassword(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'current_password' => 'required',
            'password' => 'required',
        ]);

        if (Hash::check($request->current_password, $user->password)) {
            if ($request->password_confirmation === $request->password) {
                $user->update(['password' => Hash::make($validatedData['password'])]);
                return back()->with('success', 'Password berhasil diperbarui.');
            } else {
                return back()->with('error', 'Konfirmasi Password tidak sama.');
            }
        } else {
            return back()->with('error', 'Password lama tidak cocok.');
        }
    }
}
