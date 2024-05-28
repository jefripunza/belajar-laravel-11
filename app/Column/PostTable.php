<?php

namespace App\Column;

enum PostTable: string
{
    case ID = 'posts.id';
    case Slug = 'posts.slug';
    case Title = 'posts.title';
    case Body = 'posts.body';
    case AuthorID = 'posts.author_id';
    case CreatedAt = 'posts.created_at';
}
