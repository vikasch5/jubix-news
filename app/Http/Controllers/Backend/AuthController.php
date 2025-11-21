<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController
{
    public function showLoginForm()
    {
        return view('backend.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $remember = $request->has('remember_me');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            return response()->json([
                'success' => true,
                'message' => 'Login successful.',
                'user'    => Auth::user(),
                'redirect_url' => route('admin.dashboard'),
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Invalid credentials.',
        ], 200);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin/login');
    }
}
