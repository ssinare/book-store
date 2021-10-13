@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header"> <b>Books List</b>   
                <form action="{{route('book.index')}}" method="get">
                    <fieldset>
                        <div class="list-block" >
                            <h6 style="padding-top: 10px; margin-left: 10px">Filter</h6>
                            <div class="form-group" style="margin: 10px; font-style: italic">
                                <select class="form-control" name="author_id">
                                <option value="0" disabled selected>Select Author</option>
                                @foreach ($authors as $author)
                                    <option value="{{$author->id}}" @if($author_id == $author->id) selected @endif>{{$author->name}} {{$author->surname}}</option>
                                @endforeach
                                </select>
                                <small class="form-text text-muted">Select author from the list.</small>
                            </div>                        
                            <div class="block">
                                <button type="submit" class="btn btn-light" name="filter" value="author">Filter</button>
                                <a href="{{route('book.index')}}" class="btn btn-secondary">Reset</a>
                            </div>
                        </div>
                    </fieldset>
                </form>
                </div>
               <div class="card-body">
                   <div class="mb-3">{{$books->links()}}</div>
                   <ul class="list-group">
                    @foreach ($books as $book)
                    <li class="list-group-item">
                        
                        <div class="list-block" >
                            <div class="list-block_img" style="margin: 10px; font-style: italic">
                                @if ($book->photo)
                                <img src="{{$book->photo}}">
                                @else   
                                <img src="{{asset('img/no-image.png')}}">
                                @endif
                            </div>
                            <div class="list-block_content"style="margin: 10px; font-style: italic">
                                <div><span>Book: <b>{{$book->title}}</b> </span> 
                                     <div>Publish year:<b> {{$book->year}}</b></div>
                                    <div>Author: <b> {{$book->bookByAuthor->name}} {{$book->bookByAuthor->surname}}</b></div>                
                                </div>
                            </div>
                            <div class="list-block_button">
                            <div><a href="{{route('book.edit', $book)}}" class="btn btn-light">Edit</a></div>    
                             <div><a href="{{route('book.show',[$book])}}" class="btn btn-light">Show</a> </div>    
                                <form method="POST" action="{{route('book.destroy', $book)}}">
                                <button type="submit" class="btn btn-secondary" >Delete</button>
                                @csrf
                                </form>
                            </div>
                        </div>
                    </li>      
                    @endforeach
                   </ul>
                    <div class="m-2">{{$books->links()}}</div> 
               </div>
           </div>
       </div>
   </div>
</div>
@endsection


@section('title') Books List @endsection
