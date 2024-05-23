<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function home()
    {
        return view('landing.home', [
            'title' => 'Home Page',
        ]);
    }

    public function posts(Request $request)
    {
        return view('landing.posts', [
            'title' => 'Posts Page',
            'posts' => Post::paginate(),
        ]);
    }

    public function post(string $slug)
    {
        return view('landing.post', [
            'post' => Post::findBySlug($slug),
        ]);
    }

    public function about()
    {
        return view('landing.about', [
            'title' => 'About Page',
            'name' => "Jefri Herdi Triyanto",
        ]);
    }

    public function contact()
    {
        $info = [
            "phone_number" => "082214252455",
            "email" => "jefriherditriyanto@gmail.com",
            "instagram" => "@jefripunza",
            "linkedin" => "https://www.linkedin.com/in/jefri-herdi-triyanto-ba76a8106/",
        ];
        return view('landing.contact', [
            'title' => 'Contact Page',
            'info' => $info,
        ]);
    }
}
