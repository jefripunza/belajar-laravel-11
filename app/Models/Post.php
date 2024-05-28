<?php

namespace App\Models;

use App\Column;

use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "posts";
    protected $primaryKey = Column\Post::ID->value;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        Column\Post::Slug->value,
        Column\Post::Title->value,
        Column\Post::Body->value,
        Column\Post::AuthorID->value,
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, Column\Post::AuthorID->value);
    }

    public static function formatData($post)
    {
        return [
            'post_slug' => $post->post_slug,
            'title' => $post->title,
            'body' => $post->body,
            'author' => $post->author,
            'author_slug' => $post->author_slug,
            'created_at' => $post->created_at->diffForHumans(),
            // 'created_at' => Carbon::parse($post->created_at)->format('d F Y'),
        ];
    }

    public static function paginate()
    {
        $posts = self::join('users', Column\PostTable::AuthorID->value, '=', Column\UserTable::ID->value)
            ->select(
                Column\PostTable::ID->value,
                DB::raw(Column\PostTable::Slug->value . " as post_slug"),
                Column\PostTable::Title->value,
                Column\PostTable::Body->value,
                DB::raw("CONCAT(" . Column\UserTable::FirstName->value . ", ' ', " . Column\UserTable::LastName->value . ") as author"),
                DB::raw(Column\UserTable::Username->value . " as author_slug"),
                Column\PostTable::CreatedAt->value
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
        $post = self::join('users', Column\PostTable::AuthorID->value, '=', Column\UserTable::ID->value)
            ->where(Column\PostTable::Slug->value, $post_slug)
            ->select(
                Column\PostTable::ID->value,
                DB::raw(Column\PostTable::Slug->value . " as post_slug"),
                Column\PostTable::Title->value,
                Column\PostTable::Body->value,
                DB::raw("CONCAT(" . Column\UserTable::FirstName->value . ", ' ', " . Column\UserTable::LastName->value . ") as author"),
                Column\PostTable::CreatedAt->value
            )
            ->first();
        if ($post) {
            return static::formatData($post);
        }
        return null;
    }

    /**
     * Find users by an array of user IDs.
     *
     * @param string[] $user_ids
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function findByUserIDs(array $user_ids)
    {
        return self::whereIn(Column\Post::AuthorID->value, $user_ids)->get();
    }
}
