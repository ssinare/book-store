<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Author;
use Validator;


class LoadMoreDataController extends Controller
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
    public function index()
    {
        return view('load.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function loadMoreData(Request $request)
    {
        if ($request->id > 0) {
            //info($request->id);
            info('clicked');
            $data = Comment::with('category')
                ->where('id', '<', $request->id)
                ->orderBy('id', 'DESC')
                ->limit(5)
                ->get();
        } else {
            $data = Comment::with('category')->limit(2)->orderBy('id', 'DESC')->get();
        }

        $output = '';
        $last_id = '';

        if (!$data->isEmpty()) {
            foreach ($data as $row) {
                $output .= '
                <div class="row">
                <div class="col-md-12">
                <span class="text-info">' . $row->id . '</span>
                <h3 class="text-info"><b>' . $row->name . '</b></h3>
                <p>' . $row->category->name . '</p>
                <hr />
                </div>
                </div>
                ';
                $last_id = $row->id;
            }
            $output .= '
       <div id="load_more">
        <button type="button" name="load_more_button" class="btn btn-success form-control" data-id="' . $last_id . '" id="load_more_button">Load More</button>

       </div>
       ';
        } else {
            $output .= '
       <div id="load_more">
        <button type="button" name="load_more_button" class="btn btn-info form-control">No Data Found</button>
       </div>
       ';
        }
        return $output;
    }




    public function store(Request $request)
    {
        //
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
        //
    }
}
