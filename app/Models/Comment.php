<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Author;
use App\Models\Book;

class Comment extends Model
{
    use HasFactory;

    public function commentByAuthor()
    {

        return $this->belongsTo(Author::class, 'author_id', 'id');
    }

    public function commentByBook()
    {

        return $this->belongsTo(Book::class, 'book_id', 'id');
    }
}