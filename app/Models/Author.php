<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Book;
use App\Models\Comment;
use Laravelista\Comments\Commentable;


class Author extends Model
{
    use HasFactory, Commentable;


    public function authorBooks()
    {
        return $this->hasMany(Book::class, 'author_id', 'id');
    }
}