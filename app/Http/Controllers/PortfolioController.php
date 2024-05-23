<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PortfolioController extends Controller
{

    public function public(string $slug)
    {
        $names = explode('-', $slug);
        $first_name = strtolower($names[0]);
        $last_name = strtolower(implode(' ', array_slice($names, 1)));

        $user = User::where('first_name', $first_name)
            ->where('last_name', $last_name)
            ->firstOrFail(); // Jika pengguna tidak ditemukan, akan secara otomatis memunculkan 404

        return view('portfolio.index', [
            'is_public' => true,
            'user' => $user,
        ]);
    }

    public function manage()
    {
        if (Auth::guest()) {
            return redirect()->route('login');
        }
        return view('portfolio.index', [
            'is_public' => false,
        ]);
    }

    public function editable(string $on, Request $request)
    {
        $method = $request->method();
        if (!in_array($on, ["profile", "about", "content"])) {
            return redirect()->back();
        }
        if ($method == "POST") {
            //
        }
        return view('portfolio.editable', [
            'on' => $on,
        ]);
    }
}
