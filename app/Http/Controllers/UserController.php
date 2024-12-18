<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title' => 'User',
            'users' => User::latest()->get()
        ];

        return view('user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Create User',
        ];

        return view('user.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'role' => 'required',
            'password' => 'required|min:8',
            'passwordconfirm' => 'required|same:password',
            'email' => 'required|email|lowercase|unique:users,email',
            'avatar' => 'sometimes|image|mimes:png,jpg,jpeg,svg|max:512'
        ]);

        if ($request->file('avatar')) {
            $path = $request->file('avatar')->store('img', 'public');
            $validated['avatar'] = $path;
        }

        $validated['password'] = bcrypt($request->password);
        $validated['email_verified_at'] = now();
        User::create($validated);
        return redirect()->route('user.index')->with('success', successCreateMessage());
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $data = [
            'title' => 'Detail User',
            'user' => $user
        ];

        return view('user.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $data = [
            'title' => 'Edit User',
            'user' => $user
        ];

        return view('user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required',
            'role' => 'required',
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

        $user->update($validated);
        return redirect()->route('user.index')->with('success', successUpdateMessage());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        if ($user->avatar) {
            if (Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
        }
        return redirect()->route('user.index')->with('success', successDeleteMessage());
    }
}
