<?php

namespace App\Enums;

enum PostColumn: string
{
    case ID = 'id';
    case Slug = 'slug';
    case Title = 'title';
    case Body = 'body';
    case AuthorID = 'author_id';
    case CreatedAt = 'created_at';
}

