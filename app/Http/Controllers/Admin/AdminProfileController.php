<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class AdminProfileController extends Controller
{
    public function index()
    {
        $user    = auth()->user();
        $profile = $user->adminProfile ?? AdminProfile::create(['user_id' => $user->id]);
        return view('admin.profile.index', compact('user', 'profile'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name'                  => ['required', 'string', 'max:255'],
            'email'                 => ['required', 'email', 'unique:users,email,' . $user->id],
            'avatar'                => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:1024'],
            'password'              => ['nullable', 'confirmed', Password::min(8)],
            'bio'                   => ['nullable', 'string'],
            'social_instagram'      => ['nullable', 'url'],
            'social_tiktok'         => ['nullable', 'url'],
            'social_whatsapp'       => ['nullable', 'string'],
        ]);

        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $userData = ['name' => $validated['name'], 'email' => $validated['email']];
        if (isset($validated['avatar'])) {
            $userData['avatar'] = $validated['avatar'];
        }
        if (isset($validated['password'])) {
            $userData['password'] = Hash::make($validated['password']);
        }
        $user->update($userData);

        $profile = $user->adminProfile ?? new AdminProfile(['user_id' => $user->id]);
        $profile->bio = $validated['bio'] ?? null;
        $profile->social_links = [
            'instagram' => $validated['social_instagram'] ?? null,
            'tiktok'    => $validated['social_tiktok'] ?? null,
            'whatsapp'  => $validated['social_whatsapp'] ?? null,
        ];
        $profile->save();

        return back()->with('success', 'Profil admin berhasil diperbarui! ✨');
    }
}
