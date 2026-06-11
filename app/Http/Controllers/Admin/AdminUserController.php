<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'user')->orderBy('created_at', 'desc');

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        $users = $query->paginate(15)->withQueryString();
        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        $user->load('orders', 'customOrders');
        return view('admin.users.show', compact('user'));
    }

    public function toggleActive(User $user)
    {
        // We use email_verified_at as active indicator - null = inactive
        if ($user->email_verified_at) {
            $user->update(['email_verified_at' => null]);
            $message = 'Akun user berhasil dinonaktifkan.';
        } else {
            $user->update(['email_verified_at' => now()]);
            $message = 'Akun user berhasil diaktifkan.';
        }

        return back()->with('success', $message);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'User berhasil dihapus.');
    }

    public function create() { return redirect()->route('admin.users.index'); }
    public function store(Request $request) { return redirect()->route('admin.users.index'); }
    public function edit(User $user) { return redirect()->route('admin.users.index'); }
    public function update(Request $request, User $user) { return redirect()->route('admin.users.index'); }
}
