
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
                            <div class="list-block">
                                <div class="list-block_content" style="margin: 10px; font-style: italic">
                                    <div> <b>{{$author->name}} {{$author->surname}}</b></div> 
                                    <div><span>Author about: {{$author->about}}</span></div>
                                    @if ($author->bookByAuthor->count()) 
                                    <small>Author has {{$author->bookByAuthor->count()}} books: </small>
                                    <a href="{{route('book.show',[$book])}}" class="btn btn-light">{{$book->title}}</a>
                                    {{-- <a href="{{route('book.show',$author->bookByAuthor->get())}}" class="btn btn-light">{{$book->title}}</a> --}}
                                    @else 
                                    <small>Currently has no books</small>
                                    @endif                                
                                </div>
                                <div class="list-block_button">
                                    <a href="{{route('author.edit',[$author])}}" class="btn btn-light">Edit</a>
                                    <a href="{{route('author.show',[$author])}}" class="btn btn-light">Show</a>                             
                                    <form method="POST" action="{{route('author.destroy', [$author])}}">
                                        <button type="submit" class="btn btn-secondary" >Delete</button>
                                    @csrf
                                    </form>
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
