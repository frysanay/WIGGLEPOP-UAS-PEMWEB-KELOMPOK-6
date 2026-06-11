<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function userProfile()
    {
        return view('profile.index', ['user' => auth()->user()]);
    }

    public function updateUser(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name'                  => ['required', 'string', 'max:255'],
            'email'                 => ['required', 'email', 'unique:users,email,' . $user->id],
            'phone'                 => ['nullable', 'string', 'max:20'],
            'address'               => ['nullable', 'string'],
            'avatar'                => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:1024'],
            'password'              => ['nullable', 'confirmed', Password::min(8)],
        ]);

        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return back()->with('success', 'Profil berhasil diperbarui! ✨');
    }
}
