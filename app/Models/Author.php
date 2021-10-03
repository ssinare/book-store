<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Book;
use App\Models\Comment;


class Author extends Model
{
    use HasFactory;
    public function authorBooks()
    {
        return $this->hasMany(Book::class, 'author_id', 'id');
    }

    public function authorComments()
    {
        return $this->hasMany(Comment::class, 'author_id', 'id');
    }
}