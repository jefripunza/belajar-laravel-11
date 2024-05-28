<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

use function PHPSTORM_META\map;

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
            // 'posts' => Post::all(),
            'posts' => Post::paginate(),
        ]);
    }

    public function post(string $slug)
    {
        return view('landing.post', [
            'post' => Post::findBySlug($slug),
        ]);
    }

    public function author_articles(string $username, Request $request)
    {
        $user = User::findOneByUsername($username);
        $posts = $user->posts
            ->map(fn ($post) => Post::formatData($post));
        return view('landing.posts', [
            'title' => 'Articles by ' . $user->first_name . " " . $user->last_name,
            'posts' => $posts,
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
