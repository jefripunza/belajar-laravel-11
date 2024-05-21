<?php

use Illuminate\Support\Arr;
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

$posts = [
    [
        "post_slug" => "belajar-laravel-dengan-cepat",
        "title" => "Belajar Laravel dengan Cepat?",
        "body" => "saya sedang mencoba untuk belajar laravel secepat mungkin agar bisa menembus batas 7.5 JT, demi anak bojo bree",
        "author" => "Jefri Herdi Triyanto",
        "author_slug" => "jefri-herdi-triyanto",
        "created_at" => "14 Januari 1996",
    ],
    [
        "post_slug" => "mampukah-menerima-cobaan-ini",
        "title" => "Mampukah Menerima Cobaan Ini?",
        "body" => "ketika saya niat ingsun, insya allah barokah lancar. Amiinnn....",
        "author" => "Watini",
        "author_slug" => "watini",
        "created_at" => "27 Juli 1992",
    ],
];

Route::get('/posts', function () use (&$posts) {
    return view('posts', [
        'title' => 'Posts Page',
        'posts' => $posts,
    ]);
});

Route::get('/post/{post_slug}', function ($post_slug) use (&$posts) {
    // $post = collect($posts)->firstWhere('post_slug', $post_slug);
    $post = Arr::first($posts, function ($post) use ($post_slug) {
        return $post['post_slug'] == $post_slug;
    });
    return view('post', [
        'post' => $post,
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
