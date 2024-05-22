<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function home()
    {
        return view('home', [
            'title' => 'Home Page',
        ]);
    }


    public function posts(Request $request)
    {
        return view('posts', [
            'title' => 'Posts Page',
            'posts' => Post::paginate(),
        ]);
    }


    public function post(string $slug)
    {
        return view('post', [
            'post' => Post::findBySlug($slug),
        ]);
    }

    public function about()
    {
        return view('about', [
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
        return view('contact', [
            'title' => 'Contact Page',
            'info' => $info,
        ]);
    }
}
