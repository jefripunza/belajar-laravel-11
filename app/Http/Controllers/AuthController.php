<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $title = 'Register Page';
        $method = $request->method();
        if ($method == "GET") {
            //
        } else if ($method == "POST") {
            //
        } else {
            return redirect('/');
        }
        return view('register', [
            'title' => $title,
        ]);
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
        return view('login', [
            'title' => $title,
        ]);
    }

    public function logout(Request $request)
    {
        $method = $request->method();
        if ($method == "GET") {
            return view('logout');
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
