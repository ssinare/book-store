<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Author;
use Validator;


class CommentController extends Controller
{
    const RESULTS_IN_PAGE = 5;

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $books = Book::orderBy('title', 'asc')->get();
        // $authors = Author::orderBy('surname', 'asc')->get();
        // $comments = Comment::orderBy('date', 'desc')->get();
        // if ($request->filter && 'book' == $request->filter) {
        //     $comments = Comment::where('book_id', $request->book_id)->orderBy('date', 'desc')->paginate(self::RESULTS_IN_PAGE)->withQueryString();
        // } elseif ($request->filter && 'author' == $request->filter) {
        //     $comments = Comment::where('author_id', $request->author_id)->orderBy('date', 'desc')->paginate(self::RESULTS_IN_PAGE)->withQueryString();
        // }

        // return view('comment.index', [
        //     'comments' => $comments,
        //     'sortDirection' => $request->sort_dir ?? 'asc',
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
        $books = Book::orderBy('title', 'asc')->get();
        $authors = Author::orderBy('surname', 'asc')->get();
        return view('comment.create', [
            'books' => $books,
            'book_id' => $request->book_id ?? 'null',
            'authors' => $authors,
            'author_id' => $request->author_id ?? 'null',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'comment_user' => ['required', 'min:3', 'max:30'],
                'comment_date' => ['required', 'min:4', 'max:60'],
                'comment_comment' => ['required', 'min:1', 'max:500'],
                'book_id' => ['integer', 'min:1', 'max:10000'],
                'author_id' => ['integer', 'min:1', 'max:10000'],
            ]
        );


        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        $comment = new Comment;
        $comment->user = $request->comment_user;
        $comment->date = $request->comment_date;
        $comment->comment = $request->comment_comment;
        $comment->book_id = $request->book_id;
        $comment->author_id = $request->author_id;
        $comment->save();
        return redirect()
            ->route('comment.index')
            ->with('success_message', 'New comment added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        // $books = Book::orderBy('date')->get();
        // return view('comment.edit', ['comment' => $comment, 'books' => $books]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        $books = Book::orderBy('name')->get();
        return view('comment.edit', ['comment' => $comment, 'books' => $books]);
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
        $validator = Validator::make(
            $request->all(),
            [
                'comment_user' => ['required', 'min:3', 'max:30'],
                'comment_date' => ['required', 'min:4', 'max:60'],
                'comment_comment' => ['required', 'min:1', 'max:500'],
                'book_id' => ['integer', 'min:1', 'max:10000'],
                'author_id' => ['integer', 'min:1', 'max:10000'],
            ]
        );

        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        $comment->user = $request->comment_user;
        $comment->date = $request->comment_date;
        $comment->comment = str_replace('script', '', $request->comment_comment);
        $comment->book_id = $request->book_id;
        $comment->author_id = $request->author_id;
        $comment->save();

        return redirect()
            ->route('comment.index')
            ->with('success_message', 'Comment updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()
            ->route('comment.index')
            ->with('success_message', 'The comment was deleted.');
    }
}