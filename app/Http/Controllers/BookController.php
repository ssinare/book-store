<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\Author;
use Validator;


class BookController extends Controller
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
                'book_about' => ['required', 'min:3', 'max:500'],
                'book_year' => ['required'],
                'author_id' => ['integer', 'min:1', 'max:10000'],
                'book_photo' => ['sometimes', 'image'],
            ]
        );


        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        $book = new Book;
        $file = $request->file('book_photo');

        if ($file) {
            $ext = $file->getClientOriginalExtension();
            $name = rand(1000000, 9999999) . '_' . rand(1000000, 9999999);
            $name = $name . '.' . $ext;
            $destinationPath = public_path() . '/books-img/'; //serverio kelias viduje, ne per naršyklę
            $file->move($destinationPath, $name);

            $book->photo = asset('/books-img/' . $name);
        }

        $book->title = $request->book_title;
        $book->about = str_replace('script', '', $request->book_about);
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
    public function show(Book $book, int $comments = 5)
    {
        $pageSize = $comments;

        return view('book.show', [
            'book' => $book,
            'book_title' => $book->title,
            'book_about' => $book->about,
            'pageSize' => $pageSize
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
        return view('book.edit', ['book' => $book, 'authors' => $authors]);
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
                'book_about' => ['required', 'min:3', 'max:500'],
                'book_year' => ['required'],
                'author_id' => ['integer', 'min:1', 'max:10000'],
                'book_photo' => ['sometimes', 'image'],
            ]
        );

        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $file = $request->file('book_photo');

        if ($file) {
            $ext = $file->getClientOriginalExtension();
            $name = rand(1000000, 9999999) . '_' . rand(1000000, 9999999);
            $name = $name . '.' . $ext;
            $destinationPath = public_path() . '/books-img/';
            $file->move($destinationPath, $name);
            $oldPhoto = $book->photo ?? '@';
            $book->photo = asset('/books-img/' . $name);

            $oldName = explode('/', $oldPhoto);
            $oldName = array_pop($oldName);
            if (file_exists($destinationPath . $oldName)) {
                unlink($destinationPath . $oldName);
            }
        }


        if ($request->book_photo_delete) {
            $destinationPath = public_path() . '/books-img/';
            $oldPhoto = $book->photo ?? '@';
            $book->photo = null;
            $oldName = explode('/', $oldPhoto);
            $oldName = array_pop($oldName);
            if (file_exists($destinationPath . $oldName)) {
                unlink($destinationPath . $oldName);
            }
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
        $destinationPath = public_path() . '/books-img/';
        $oldPhoto = $book->photo ?? ' ';
        $oldName = explode('/', $oldPhoto);
        $oldName = array_pop($oldName);
        if (file_exists($destinationPath . $oldName)) {
            unlink($destinationPath . $oldName);
        }

        $book->delete();
        return redirect()
            ->route('book.index')
            ->with('success_message', 'The book was deleted.');
    }
}