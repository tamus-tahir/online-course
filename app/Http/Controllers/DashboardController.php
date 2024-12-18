<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.index', ['title' => 'Dashboard']);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $data = [
            'title' => 'My Profile',
            'user' => account()
        ];

        return view('dashboard.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $data = [
            'title' => 'Edit Profile',
            'user' => account()
        ];

        return view('dashboard.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $user = account();
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|lowercase|unique:users,email,' . $user->id,
            'avatar' => 'sometimes|image|mimes:png,jpg,jpeg,svg|max:512'
        ]);

        if ($request->password) {
            $validated = $request->validate([
                'password' => 'required|min:8',
                'passwordconfirm' => 'required|same:password',
            ]);
            $validated['password'] = bcrypt($request->password);
        }

        if ($request->file('avatar')) {
            $path = $request->file('avatar')->store('img', 'public');
            $validated['avatar'] = $path;
            if ($user->avatar) {
                if (Storage::disk('public')->exists($user->avatar)) {
                    Storage::disk('public')->delete($user->avatar);
                }
            }
        }

        User::where('id', $user->id)->update($validated);
        return redirect()->route('dashboard')->with('success', successUpdateMessage());
    }
}
