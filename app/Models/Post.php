<?php

namespace App\Models;

class Post
{
    public static function all()
    {
        return [
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
    }
}
