<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller {
    public function index() {
        $user = Auth::user();
        return view('fronsite.profile', compact('user'));
    }

    public function update(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        $user = Auth::user();
        $data = $request->only(['name', 'phone', 'address']);
        if ($request->hasFile('avatar')) {
            if ($user->avatar) @unlink(public_path('assets/img/avatars/'.$user->avatar));
            $avatarName = time().'_'.$request->file('avatar')->getClientOriginalName();
            $request->file('avatar')->move(public_path('assets/img/avatars'), $avatarName);
            $data['avatar'] = $avatarName;
        }
        $user->update($data);
        return redirect()->back()->with('success', 'Profil berhasil diperbarui');
    }

    public function updatePassword(Request $request) {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);
        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini tidak sesuai']);
        }
        Auth::user()->update(['password' => Hash::make($request->password)]);
        return redirect()->back()->with('success', 'Password berhasil diubah');
    }
}
