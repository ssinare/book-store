@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">  
                    <div>Book: <h5>{{$book->title}}, publish year: {{$book->year}}</h5></div> 
                    {{-- <?php
                    dd($book->bookByAuthor);  
                    ?>                 --}}
                     <div> Author:<h6> {{$book->bookByAuthor->name}}{{$book->bookByAuthor->surname}}</h6></div>        
                
                    </div>
                <div class="card-body">
                    <div class="list-block">
                        <div class="book-container">
                            <div class="book-container__book">
                                <div> <b> About the book: </b></div>
                                <div> {{$book->about}}   </div>  
                                <div>  <b>Readers comments: </b>                                 
                                @foreach ($book->bookComments as $comment)                            
                                    <ul>  <div>{{$comment->date}} {{$comment->user}}</div>
                                            <div>{{$comment->comment}}</div> 
                                    </ul>                             
                                @endforeach           
                            </div> 
                            {{-- <div><a href="{{route('comment.create',[$comment])}}" class="btn btn-secondary m-2">Add comment</a></a></div>                              --}}
                        </div>
                    </div>
                   </div>                     
                        <a href="{{route('book.edit',[$book])}}" class="btn btn-secondary m-2">Edit</a></a>                       
                    </div>
            </div>                
           </div>
       </div>
   </div>
</div>



@endsection

@section('title') {{$book->name}} @endsection
