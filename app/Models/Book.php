<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Author;

class Book extends Model
{
    use HasFactory;

    public function bookByAuthor()
    {

        return $this->belongsTo(Author::class, 'author_id', 'id');
    }
    public function bookComments()
    {
        return $this->hasMany(Comment::class, 'book_id', 'id');
    }
}