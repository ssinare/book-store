<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Author;
use Validator;

//use Laravelista\Comments\CommentController;

class CommentController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function livewire()
    {

        return view(view: 'livewire');
    }


    public function index(Request $request)
    {
        // $books = Book::orderBy('title', 'asc')->get();
        // $authors = Author::orderBy('surname', 'asc')->get();
        // if ($request->book_id == null) {
        //     $comments = Comment::where('author_id', $request->author_id)
        //         ->orderBy('date', 'desc')
        //         ->paginate(5);
        // } else {
        //     $comments = Comment::where('book_id', $request->book_id)
        //         ->orderBy('date', 'desc')
        //         ->paginate(5);
        // }

        // return view('comment.index', [
        //     'comments' => $comments,
        //     'sortDirection' => $request->sort_dir ?? 'desc',
        //     'books' => $books,
        //     'book_id' => $request->book_id ?? 'null',
        //     'authors' => $authors,
        //     'author_id' => $request->author_id ?? 'null',
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // $books = Book::orderBy('title', 'asc')->get();
        // $authors = Author::orderBy('surname', 'asc')->get();

        // return view('comment.create', [
        //     'books' => $books,
        //     'book_id' => $request->book_id ?? 'null',
        //     'authors' => $authors,
        //     'author_id' => $request->author_id ?? 'null',
        // ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //     $validator = Validator::make(
        //         $request->all(),
        //         [
        //             'comment_user' => ['required', 'min:3', 'max:30'],
        //             'comment_date' => ['required', 'min:4', 'max:60'],
        //             'comment_comment' => ['required', 'min:1', 'max:500'],
        //             'book_id' => ['integer', 'min:1', 'max:10000'],
        //             'author_id' => ['integer', 'min:1', 'max:10000'],
        //         ]
        //     );


        //     if ($validator->fails()) {
        //         $request->flash();
        //         return redirect()->back()->withErrors($validator);
        //     }
        //     $comment = new Comment;
        //     $comment->user = $request->comment_user;
        //     $comment->date = $request->comment_date;
        //     $comment->comment = $request->comment_comment;
        //     $comment->book_id = $request->book_id;
        //     $comment->author_id = $request->author_id;
        //     $comment->save();
        //     return redirect()
        //         ->route('comment.index')
        //         ->with('success_message', 'New comment added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        // $comment->delete();
        // return redirect()
        //     ->route('comment.index')
        //     ->with('success_message', 'The comment was deleted.');
    }
}