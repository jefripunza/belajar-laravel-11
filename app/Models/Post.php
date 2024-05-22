<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "posts";
    protected $primaryKey = "id";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'slug',
        'title',
        'body',
        'author_id',
    ];

    public static function formatData($post)
    {
        return [
            'post_slug' => $post->post_slug,
            'title' => $post->title,
            'body' => $post->body,
            'author' => $post->author,
            'author_slug' => Str::slug($post->author),
            'created_at' => $post->created_at->diffForHumans(),
            // 'created_at' => Carbon::parse($post->created_at)->format('d F Y'),
        ];
    }

    public static function listAll()
    {
        $posts = Post::join('users', 'posts.author_id', '=', 'users.id')
            ->select(
                'posts.slug as post_slug',
                'posts.title',
                'posts.body',
                'users.name as author',
                'posts.created_at'
            )
            ->get()
            ->map(fn ($post) => static::formatData($post));
        return $posts;
    }

    public static function findBySlug($post_slug)
    {
        // $post = collect(static::all())->firstWhere('post_slug', $post_slug);
        // $post = Arr::first(static::all(), function ($post) use ($post_slug) {
        //     return $post['post_slug'] == $post_slug;
        // });
        // $post = Arr::first(static::all(), fn ($post) => $post['post_slug'] == $post_slug);
        $post = Post::join('users', 'posts.author_id', '=', 'users.id')
            ->where('posts.slug', $post_slug)
            ->select(
                'posts.slug as post_slug',
                'posts.title',
                'posts.body',
                'users.name as author',
                'posts.created_at'
            )
            ->first();
        if ($post) {
            return static::formatData($post);
        }
        return null;
    }
}
