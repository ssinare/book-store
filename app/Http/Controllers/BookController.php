<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Comment;
use Validator;
use PDF;

class BookController extends Controller
{
    const RESULTS_IN_PAGE = 6;

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
        $authors = Author::orderBy('surname', 'asc')->get();
        if ($request->filter && 'author' == $request->filter) {
            $books = Book::where('author_id', $request->author_id)->orderBy('year', 'desc')->paginate(self::RESULTS_IN_PAGE)->withQueryString();
        } else {

            $books = Book::orderBy('year', 'desc')->paginate(self::RESULTS_IN_PAGE)->withQueryString();
        }

        return view('book.index', [
            'books' => $books,
            'sortDirection' => $request->sort_dir ?? 'desc',
            'authors' => $authors,
            'author_id' => $request->author_id ?? '0',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = Author::orderBy('surname', 'asc')->get();
        return view('book.create', ['authors' => $authors]);
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
                'book_title' => ['required', 'min:3', 'max:60'],
                'book_about' => ['required', 'min:3', 'max:200'],
                'book_year' => ['required', 4],
                'author_id' => ['integer', 'min:1', 'max:10000'],
            ]
        );


        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        $book = new Book;
        $book->title = $request->book_title;
        $book->about = $request->book_about;
        $book->year = $request->book_year;
        $book->author_id = $request->author_id;
        $book->save();
        return redirect()
            ->route('book.index')
            ->with('success_message', 'New book added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        $authors = Author::orderBy('surname', 'asc')->get();
        $comments = Comment::orderBy('date', 'desc')->get();

        return view('book.show', [
            'book' => $book,
            'book_title' => $book->title,
            'book_about' => $book->about,
            'comments' => $comments,
            'authors' => $authors,

        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $authors = Author::orderBy('surname')->get();
        $comments = Comment::orderBy('date', 'desc')->get();
        return view('book.edit', ['book' => $book, 'authors' => $authors, 'comments' => $comments]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'book_title' => ['required', 'min:3', 'max:60'],
                'book_about' => ['required', 'min:3', 'max:200'],
                'book_year' => ['required'],
                'author_id' => ['integer', 'min:1', 'max:10000'],
            ]
        );

        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        $book->title = $request->book_title;
        $book->about = str_replace('script', '', $request->book_about);
        $book->year = $request->book_year;
        $book->author_id = $request->author_id;
        $book->save();

        return redirect()
            ->route('book.index')
            ->with('success_message', 'Book updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()
            ->route('book.index')
            ->with('success_message', 'The book was deleted.');
    }
    public function pdf(Book $book)
    {
        $pdf = PDF::loadView('book.pdf', ['book' => $book]);
        return $pdf->download($book->title . '.pdf');
    }
}