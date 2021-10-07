<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use App\Models\Book;
use Validator;
use PDF;

class AuthorController extends Controller
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
    public function index()
    {
        $authors = Author::orderBy('surname', 'asc')->paginate(self::RESULTS_IN_PAGE)->withQueryString();
        $books = Book::orderBy('title', 'asc')->paginate(self::RESULTS_IN_PAGE)->withQueryString();

        return view(
            'author.index',
            [
                'authors' => $authors,
                'books' => $books,
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('author.create');
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
                'author_name' => ['required', 'min:3', 'max:60'],
                'author_surname' => ['required', 'min:3', 'max:60'],
                'author_about' => ['required', 'min:1', 'max:500'],
            ]
        );


        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $author = new Author;

        $file = $request->file('author_photo');
        $ext = $file->getClientOriginalExtension();
        $name = rand(1000000, 9999999) . '_' . rand(1000000, 9999999);
        $name = $name . '.' . $ext;
        $destinationPath = public_path() . '/authors-img/'; //serverio kelias viduje, ne per naršyklę
        $file->move($destinationPath, $name);
        $author->photo = asset('/authors-img/' . $name);

        $author->name = $request->author_name;
        $author->surname = $request->author_surname;
        $author->about = $request->author_about;
        $author->save();
        return redirect()
            ->route('author.index')
            ->with('success_message', 'New author added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        $books = Book::orderBy('title')->get();
        return view('author.show', [
            'author' => $author,
            'author_name' => $author->name,
            'author_surname' => $author->surname,
            'books' => $books,
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $author)
    {
        return view('author.edit', ['author' => $author]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Author $author)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'author_name' => ['required', 'min:3', 'max:60'],
                'author_surname' => ['required', 'min:3', 'max:60'],
                'author_about' => ['required', 'min:1', 'max:500'],
            ]
        );

        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        $author->name = $request->author_name;
        $author->surname = $request->author_surname;
        $author->about = $request->author_about;
        $author->save();
        return redirect()
            ->route('author.index')
            ->with('success_message', 'The author was updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        if ($author->authorBooks->count()) {
            return redirect()
                ->route('author.index')
                ->with('danger_message', 'The author has books. Can not be deleted.');
        }

        $author->delete();
        return redirect()
            ->route('author.index')
            ->with('success_message', 'The author was deleted.');
    }
    public function pdf(Author $author)
    {
        $pdf = PDF::loadView('author.pdf', ['author' => $author]);
        return $pdf->download($author->name . ' ' . $author->surname . '.pdf');
    }
}