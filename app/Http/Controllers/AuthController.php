<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\ActivationEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $title = 'Register Page';
        $method = $request->method();
        if ($method == "GET") {
            if (!Auth::guest()) {
                return redirect()->route('portfolio');
            }
        } else if ($method == "POST") {
            $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'nullable|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'gender' => 'required|in:male,female',
                'birthday' => 'required|date',
                'password' => [
                    'required',
                    'string',
                    'min:8', // Minimum 8 characters
                    'regex:/[A-Z]/', // Must contain at least one uppercase letter
                    'regex:/[a-z]/', // Must contain at least one lowercase letter
                    'regex:/[0-9]/', // Must contain at least one digit
                    'regex:/[\W_]/' // Must contain at least one special character
                ],
            ]);
            // dd($request);

            $activation_code = Str::random(60); // Generate activation code
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'activation_code' => $activation_code,
                'gender' => $request->gender,
                'birthday_date' => $request->birthday,
                'remember_token' => Str::random(10),
            ]);

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
            return redirect()->route('login')->with('error', 'Invalid activation code.');
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
            if (!Auth::guest()) {
                return redirect()->route('portfolio');
            }
        } else {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);
            $credentials = $request->only('email', 'password');
            $user = User::where('email', $credentials['email'])
                ->whereNotNull('activation_at')
                ->first();
            if ($user && Hash::check($credentials['password'], $user->password)) {
                // join ke sini semua untuk kebutuhan get data...
                Auth::login($user);
                return redirect()->intended('/portfolio');
            } else {
                return back()->withErrors(['email' => 'Invalid email or password.'])->withInput($request->only('email'));
            }
        }
        return view('auth.login', [
            'title' => $title,
        ]);
    }

    public function logout(Request $request)
    {
        $method = $request->method();
        if ($method == "GET") {
            Auth::logout();
            return redirect('/login');
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
