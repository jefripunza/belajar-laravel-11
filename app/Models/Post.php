<?php

namespace App\Models;

use App\Enums;

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
    protected $primaryKey = Enums\PostColumn::ID->value;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        Enums\PostColumn::Slug->value,
        Enums\PostColumn::Title->value,
        Enums\PostColumn::Body->value,
        Enums\PostColumn::AuthorID->value,
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, Enums\PostColumn::AuthorID->value);
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
        $posts = self::join('users', Enums\PostTableColumn::AuthorID->value, '=', Enums\UserTableColumn::ID->value)
            ->select(
                Enums\PostTableColumn::ID->value,
                DB::raw(Enums\PostTableColumn::Slug->value . " as post_slug"),
                Enums\PostTableColumn::Title->value,
                Enums\PostTableColumn::Body->value,
                DB::raw("CONCAT(" . Enums\UserTableColumn::FirstName->value . ", ' ', " . Enums\UserTableColumn::LastName->value . ") as author"),
                DB::raw(Enums\UserTableColumn::Username->value . " as author_slug"),
                Enums\PostTableColumn::CreatedAt->value
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
        $post = self::join('users', Enums\PostTableColumn::AuthorID->value, '=', Enums\UserTableColumn::ID->value)
            ->where(Enums\PostTableColumn::Slug->value, $post_slug)
            ->select(
                Enums\PostTableColumn::ID->value,
                DB::raw(Enums\PostTableColumn::Slug->value . " as post_slug"),
                Enums\PostTableColumn::Title->value,
                Enums\PostTableColumn::Body->value,
                DB::raw("CONCAT(" . Enums\UserTableColumn::FirstName->value . ", ' ', " . Enums\UserTableColumn::LastName->value . ") as author"),
                Enums\PostTableColumn::CreatedAt->value
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
        return self::whereIn(Enums\PostColumn::AuthorID->value, $user_ids)->get();
    }
}
