<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', [
        'title' => 'Home Page',
    ]);
});

Route::get('/about', function () {
    return view('about', [
        'title' => 'About Page',
        'name' => "Jefri Herdi Triyanto",
    ]);
});

Route::get('/posts', function () {
    return view('posts', [
        'title' => 'Posts Page',
        'posts' => Post::listAll(),
    ]);
});

Route::get('/post/{post_slug}', function ($post_slug) {
    return view('post', [
        'post' => Post::findBySlug($post_slug),
    ]);
});

Route::get('/contact', function () {
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
});
