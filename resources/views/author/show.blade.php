@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">  
                    <div>Author: <h5>{{$author->name}} {{$author->surname}}</h5></div>                   
                    @if  ( $author->authorBooks->count() === 1) 
                        <div> Author has:<h6> {{$author->authorBooks->count()}} book </h6></div>
                    @else 
                        <div> Author has:<h6> {{$author->authorBooks->count()}} books </h6></div>
                    @endif
                    </div>
                <div class="card-body">
                    <div class="list-block">
                        <div class="author-container">
                            <div class="book-container__book">                            
                                <div style="margin: 10px; font-style: italic"> 
                                    <b>  About author: </b>
                                 <div>{{$author->about}} </div>  
                                </div> 
                                
                                <div>                     
                                    <a href="{{route('author.edit',[$author])}}" class="btn btn-secondary m-2">Edit</a>
                                    <a href="{{route('author.pdf',[$author])}}" class="btn btn-secondary m-2">PDF</a>                       
                                </div>

                                <div style="readers-container; margin: 10px; font-style: italic">  
                                    <div style="margin-bottom: 10px"><b>Readers comments: </b></div>
                                    
                                    <div >                                                                  
                                        @comments(['model' => $author])
                                    </div>                                         
                                </div>         
                            </div>
                            <div style="margin: 10px; font-style: italic"> 
                                    <b>Books: </b> 
                            @foreach ($author->authorBooks as $book) 
                                   <ul><a href="{{route('book.show',[$book])}}" class="btn btn-secondary m-2">{{$book->title}}, {{$book->year}}</a></ul>                           
                            @endforeach            
                            </div>                             
                        </div>                        
                    </div> 
                </div>                
           </div>
       </div>
   </div>
</div>

@endsection


@section('title') {{$author->name}} {{$author->surname}} @endsection
