<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function loginPage()
    {
        return view("auth.login");
    }
    public function registerPage()
    {
        return view("auth.register");
    }

    public function login(Request $request)
    {

        $validated = $request->validate([
            'email' => 'email|required|exists:users,email',
            'password' => 'required|min:3'
        ]);

        $user = User::where('email', $validated['email'])->first();
        if ($user && Hash::check($validated['password'], $user->password)) {
            Auth::login($user);

            if ($user->role == "ADMIN") {
                return redirect()->route('admin.dashboard')->with('success', 'Login successfull!');
            }

            return redirect("/")->with('success', 'Login successfull!');
        }
        return redirect('/login')->with('error', 'Wrong Credentials');
    }

    public function register(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|min:3|max:255',
            'terms' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:3'
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'USER'
        ]);

        Auth::login($user);
        return redirect("/")->with('message', 'Regestration successful!');
    }

    public function logout(Request $request)
    {
        if (Auth::check()) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/login')->with('success', 'Logout successful!');
        }
        return redirect('/');
    }


    public function forgotPassword(Request $request)
    {
        $email = session('email') ?? '';
        return view('auth.forgot_password', compact('email'));
    }

    public function sendResetPasswordEmail(Request $request)
    {

        $validated = $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        $email = $validated['email'];

        return view('auth.forgot_password', compact('email'));
    }
}
