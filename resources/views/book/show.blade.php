@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-9">
           <div class="card">
               <div class="card-header_show">  
                    <div class="card-header_heading">
                        <div>Book:<h5> <b>{{$book->title}}</b></h5></div> 
                        <div> Author:<h6> <b>{{$book->bookByAuthor->name}} {{$book->bookByAuthor->surname}}</b> </h6></div>        
                        <div>Publish year: {{$book->year}}</div>                    
                    </div> 
                    <div class="card-header_heading">   
                        <div class="img" style="margin: 10px; font-style: italic">
                            <img src="{{$book->photo}}">                    
                        </div>                
                    </div>     
                </div>
                
                <div class="card-body" >
                    <div class="list-block">
                        <div class="book-container">
                            <div class="book-container__book">
                                <div style="margin: 10px; font-style: italic"> 
                                    <b> About the book: </b>
                                 <div>{!!$book->about!!} </div>  
                                </div> 
                         
                                <div>                     
                                    <a href="{{route('book.edit',[$book])}}" class="btn btn-secondary m-2">Edit</a>                       
                                </div>

                                <div style="readers-container; margin: 10px; font-style: italic">  
                                    <div style="margin-bottom: 10px"><b>Readers comments: </b></div>
                                    <div >                             
                                        @comments(['model' => $book]) 
                                    </div>
                                </div> 
                             </div>                        
                        </div>
                    </div>                   
                </div>                
           </div>
       </div>
   </div>
</div>



@endsection


@section('title') {{$book->name}} @endsection
