@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Customers edit</div>
                    <div class="card-body">
                        <div class="list-block">
                        <form action="{{route('book.update', $book)}}" method="post">                                                  
                             <div class="form-group" style="margin: 10px; font-style: italic">
                                <label>   Title: </label>
                                <input type="text" name="book_title" class="form-control" value="{{old('book_title', $book->title)}}">
                                <small class="form-text text-muted">   Update book title</small>
                            </div>               
                            <div class="form-group" style="margin: 10px; font-style: italic">
                                <label>   About: </label>
                                <textarea type="text" name="book_about" id="summernote" class="form-control" >{{old('book_about', $book->about)}}</textarea>
                                <small class="form-text text-muted">   Update comment about the book</small>
                            </div>
                             <div class="form-group" style="margin: 10px; font-style: italic">
                                <label>   Publish year: </label>
                                <input type="text" name="book_year" class="form-control" value="{{old('book_year', $book->year)}}">
                                <small class="form-text text-muted">   Update book publish year</small>
                            </div>                         
                            <div class="form-group" style="margin: 10px; font-style: italic">
                                <label>   Author: </label>
                                <select type="text" name="author_id" class="form-control">
                                    @foreach ($authors as $author)
                                        <option value="{{$author->id}}"@if(old('author_id', $book->author_id) == $author->id)  selected @endif>{{$author->name}} {{$author->surname}}</option>
                                    @endforeach
                                </select>
                                <small class="form-text text-muted">   Select author from the list</small>                                
                            </div>                                    
                            <div class="form-group" style="margin: 10px">                         
                                <button class="btn btn-light" type="submit" >Update</button>                            
                            </div> 
                            @csrf                       
                        </form>
                        </div>
                    </div>
               </div>
           </div>
       </div>
   </div>
</div>

<script>
$(document).ready(function() {
   $('#summernote').summernote();
 });
</script>

@endsection

@section('title') Customers edit @endsection