<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
        $admin = Admin::where('email', $data['email'])->first();
        if ($admin && Hash::check($data['password'], $admin->password)) {
            Auth::guard('admin')->login($admin);
            return redirect()->route('stories.create',  ['adminEmail' => $admin->email]);
        }
        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function logoutUser()
    {
        Auth::logout();
        return redirect()->route('login');
    }

}
