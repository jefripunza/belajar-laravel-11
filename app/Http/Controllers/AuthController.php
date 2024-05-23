<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\ActivationEmail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $title = 'Register Page';
        $method = $request->method();
        if ($method == "GET") {
            // skip...
        } else if ($method == "POST") {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
            ]);

            $activation_code = Str::random(60); // Generate activation code
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'activation_code' => $activation_code,
            ]);

            // // Auto-login user setelah registrasi
            // auth()->login($user);

            // Kirim email aktivasi
            Mail::to($user->email)->send(new ActivationEmail($user));

            return redirect()->route('login')->with('success', 'Registration successful! Activation email sent.');
        } else {
            return redirect('/');
        }
        return view('auth.register', [
            'title' => $title,
        ]);
    }

    public function activateAccount($code)
    {
        $user = User::where('activation_code', $code)->first();
        if (!$user) {
            return redirect()->route('home')->with('error', 'Invalid activation code.');
        }

        // Aktifkan akun
        $user->activation_at = now();
        $user->activation_code = null;
        $user->save();

        return redirect()->route('login')->with('success', 'Your account has been activated successfully.');
    }

    public function login(Request $request)
    {
        $title = 'Login Page';
        $method = $request->method();
        if ($method == "GET") {
            //
        } else {
            return redirect('/');
        }
        return view('auth.login', [
            'title' => $title,
        ]);
    }

    public function logout(Request $request)
    {
        $method = $request->method();
        if ($method == "GET") {
            // 
        } else {
            return redirect('/');
        }
    }

    public function forgotPassword(Request $request)
    {
        $title = 'Forgot Password Page';
        $method = $request->method();
        if ($method == "GET") {
            //
        } else {
            return redirect('/');
        }
        return view('forgot-password', [
            'title' => $title,
        ]);
    }
}
