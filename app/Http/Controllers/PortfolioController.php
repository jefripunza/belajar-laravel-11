<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function manage()
    {
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
