
@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Authors List</div>
               <div class="card-body">
                    <div class="mb-3">{{$authors->links()}}</div> 
                    <ul class="list-group">
                        @foreach ($authors as $author)
                        <li class="list-group-item">
                            <div class="list-block" style="margin-top: 10px;">
                                <div class="list-block_img" style="margin: 10px; font-style: italic">
                                    @if ($author->photo)
                                    <img src="{{$author->photo}}">
                                    @else   <img src="{{asset('img/no-image.png')}}">
                                    @endif
                                </div>
                                <div class="list-block_content" style="margin: 10px; font-style: italic">
                                    <div>
                                    <div> <b>{{$author->name}} {{$author->surname}}</b></div>                                 
                                    @if ($author->authorBooks  !== null)
                                        @if  ( $author->authorBooks->count())
                                            @if  ( $author->authorBooks->count() < 2) 
                                        <small>Author has {{$author->authorBooks->count()}} book: </small>
                                            @else 
                                        <small>Author has {{$author->authorBooks->count()}} books: </small>
                                            @endif
                                        @foreach($author->authorBooks as $book)
                                        <ul><a href="{{route('book.show',[$book])}}" class=" btn btn-secondary">{{$book->title}}</a></ul>
                                        @endforeach 
                                        @else 
                                        <small>Currently has no books</small>
                                        @endif
                                    @else 
                                    <small>Currently has no books</small>
                                    @endif 
                                    </div>                               
                                </div>
                                <div class="list-block_button">
                                    <div><a href="{{route('author.edit',[$author])}}" class="btn btn-light">Edit</a></div>
                                    <div><a href="{{route('author.show',[$author])}}" class="btn btn-light">Show</a></div>                             
                                    <div>
                                        <form method="POST" action="{{route('author.destroy', [$author])}}">
                                        <button type="submit" class="btn btn-secondary" >Delete</button>
                                        @csrf
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach 
                    </ul>
                    <div class="m-2">{{$authors->links()}}</div>       
               </div>
           </div>
       </div>
   </div>
</div>
@endsection


@section('title') Authors List @endsection
