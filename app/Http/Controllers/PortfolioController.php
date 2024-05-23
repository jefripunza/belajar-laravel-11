<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PortfolioController extends Controller
{
    public function manage()
    {
        if (Auth::guest()) {
            return redirect()->route('login');
        }
        return view('user.portfolio', [
            'title' => "User Page",
        ]);
    }
    public function public()
    {
        return view('user.portfolio', [
            'title' => "User Page",
        ]);
    }
}
