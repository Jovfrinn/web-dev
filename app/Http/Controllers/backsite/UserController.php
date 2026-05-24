<?php

namespace App\Http\Controllers\backsite;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index(Request $request)
    {
        // Only Super Admin can access this
        if (!Auth::user()->isSuperAdmin()) {
            return redirect()->route('admin.dashboard')->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
        }

        $query = User::query();

        // Optional search filter
        if ($request->has('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
        }

        // Exclude the current super admin from the list so they don't accidentally demote themselves
        $query->where('id', '!=', Auth::id());

        $users = $query->latest()->paginate(15);

        return view('backsite.users', compact('users'));
    }

    /**
     * Update the role of the specified user.
     */
    public function updateRole(Request $request, $id)
    {
        // Only Super Admin can access this
        if (!Auth::user()->isSuperAdmin()) {
            return redirect()->route('admin.dashboard')->with('error', 'Akses ditolak.');
        }

        $request->validate([
            'id_role' => 'required|in:1,2,3' // 1: Super Admin, 2: Admin, 3: Customer
        ]);

        $user = User::findOrFail($id);

        // Prevent modifying the current logged-in user
        if ($user->id == Auth::id()) {
            return back()->with('error', 'Anda tidak dapat mengubah role Anda sendiri.');
        }

        $user->id_role = $request->id_role;
        $user->save();

        return back()->with('success', 'Role pengguna berhasil diperbarui.');
    }
}
