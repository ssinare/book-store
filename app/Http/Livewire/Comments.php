<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Http\Livewire\Comment;

class Comments extends Component
{
    public $amount = 5;

    public function render()
    {
        $comments = Comment::take($this->amount)->get();
        return view(view: 'livewire.comments', compact(varname: 'comments'));
    }
    public function load()
    {

        $this->amount += 5;
    }
}