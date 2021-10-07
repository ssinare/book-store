<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Comment extends Model
{
    protected $fillable = ['guest_name', 'guest_email', 'comment', 'commentable_type', 'commentable_id', 'created_at'];

    use HasFactory;
}