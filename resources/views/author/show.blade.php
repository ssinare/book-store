@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">  
                    <div>Author: <h5>{{$author->name}} {{$author->surname}}</h5></div>                   
                     <div> Author has:<h6> {{$author->authorBooks->count()}} books </h6></div>        
                </div>
                <div class="card-body">
                    <div class="list-block">
                        <div class="author-container">
                            <div class="author-container__book">
                            <div>  Author: <b> {{$author->name}} {{$author->surname}}  </b> </div> 
                             <div>  About: <b> {{$author->about}}  </b> </div>  
                            <div>  <b>Comments about the author: </b> 
                            @foreach ($author->authorComments as $comment) 
                                   <li><div>{{$comment->date}} {{$comment->user}}</div>,
                                    <div>{{$comment->comment}}</div> 
                                </li>                           
                            @endforeach            
                            </div> 
                            <div><a href="{{route('comment.create',[$comment])}}" class="btn btn-secondary m-2">Add comment</a></a></div>
                            <div>  <b>Books: </b> 
                            @foreach ($author->authorBooks as $book) 
                                   <li>{{$book->title}}, {{$book->year}}</li>                           
                            @endforeach            
                            </div> 
                        </div>
                    </div>
                   </div>
                     
                        <a href="{{route('author.edit',[$author])}}" class="btn btn-secondary m-2">Edit</a></a>
                        <a href="{{route('author.pdf',[$author])}}" class="btn btn-secondary m-2">PDF</a></a>
                    </div>
            </div>
                
           </div>
       </div>
   </div>
</div>



@endsection

@section('title') {{$author->name}} @endsection
