@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">  
                    <div>Book:<h5> <b>{{$book->title}}</b></h5></div> 
                    <div> Author:<h6> <b>{{$book->bookByAuthor->name}} {{$book->bookByAuthor->surname}}</b> </h6></div>        
                     <div>Publish year: {{$book->year}}</div> 
                </div>
                <div class="card-body" >
                    <div class="list-block">
                        <div class="book-container">
                            <div class="book-container__book">
                                <div style="margin: 10px; font-style: italic"> 
                                    <b> About the book: </b>
                                 <div>{{$book->about}} </div>  
                                </div> 
                                
                                <div>                     
                                    <a href="{{route('book.edit',[$book])}}" class="btn btn-secondary m-2">Edit</a>                       
                                </div>

                                <div style="readers-container; margin: 10px; font-style: italic">  
                                    <b>Readers comments: </b>  
                                    <div class="readers-container__comments">                             
                                        @foreach ($book->bookComments as $comment)                            
                                            <ul style=" margin: 10px; padding: 10px;">
                                                <li> 
                                                <div>{{$comment->date}} {{$comment->user}}</div>
                                                    <div>{{$comment->comment}}</div> 
                                                </li> 
                                                </ul>                             
                                        @endforeach 
                                        <div><a href="" class="btn btn-light m-2">Load more</a></div> 
                                        <div><a href="{{route('comment.create',[$comment])}}" class="btn btn-light m-2">Add new</a></div>
                                       
                                    </div>
                                    <div>
                                        @comments(['model' => $book]) 
                                    </div>
                                    
                                     <form action="{{route('book.show',[$book])}}" method="post">                       
                                        <div class="form-group" style="margin: 10px; font-style: italic">
                                            <label>Name:</label>
                                            <input type="text" name="comment_name" class="form-control" value="{{old('comment_name')}}">
                                            <small class="form-text text-muted">   Enter your name</small>
                                        </div>
                                        <div class="form-group" style="margin: 10px; font-style: italic">
                                            <label>Comment:</label>
                                            <input type="text" name="comment_comment" class="form-control" value="{{old('comment_comment')}}">
                                            <small class="form-text text-muted">   Enter comment</small>
                                        </div>
                                        <div class="form-group" style="margin: 10px">                         
                                            <button class="btn btn-light" type="submit" >Save</button>                            
                                        </div> 
                                        @csrf
                                    </form>              
                                </div> 
                                {{-- <div class="mb-3">{{$comments->links()}}</div>  --}}
                                                      
                        </div>
                    </div>                   
                </div>                
           </div>
       </div>
   </div>
</div>



@endsection
@yield('footer-content')

@section('title') {{$book->name}} @endsection
