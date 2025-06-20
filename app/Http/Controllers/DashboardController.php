<?php

namespace App\Http\Controllers;

use App\Models\Template;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function dashboard() {
        $templates = Template::get();
         $projects = \App\Models\Design::where('user_id', Auth::id())->latest()->get();
        return view('admin.dashboard', compact('projects','templates'));
    }
    public function project() {
         $projects = \App\Models\Design::where('user_id', Auth::id())->latest()->get();
        return view('admin.project',  compact('projects'));
    }
     public function edit()
    {
        return view('admin.profile.edit');
    }
    public function show()
{
    return view('admin.profile.show');
}

    public function update(Request $request)
{
    $user = User::find(Auth::id());

    if (!$user) {
        abort(403, 'User tidak ditemukan.');
    }

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        'password' => 'nullable|string|min:6',
    ]);

    $user->name = $request->name;
    $user->email = $request->email;

    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    $user->save();

    return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui.');
}

 public function admin()
    {
        // Hanya untuk user bernama "Admin"
        if (Auth::user()->name !== 'Admin') {
            abort(403, 'Akses ditolak.');
        }

        $users = User::where('name', '!=', 'Admin')->get();
        return view('admin.users', compact('users'));
    }

    public function makePremium($id)
    {
        $user = User::findOrFail($id);
        $user->is_premium = true;
        $user->save();

        return redirect()->route('admin.users')->with('success', 'Akun berhasil dijadikan premium.');
    }

    public function makeGratis($id)
    {
        $user = User::findOrFail($id);
        $user->is_premium = false;
        $user->save();

        return redirect()->route('admin.users')->with('success', 'Akun berhasil dijadikan gratis.');
    }
   
}
