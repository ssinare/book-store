<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Author;
use Laravelista\Comments\Commentable;


class Book extends Model
{
    use HasFactory, Commentable;

    //     @comments([
    //     'model' => $book,
    //     'approved' => true
    // ])

    public function bookByAuthor()
    {

        return $this->belongsTo(Author::class, 'author_id', 'id');
    }
    public function bookComments()
    {
        return $this->hasMany(Comment::class, 'book_id', 'id');
    }
}