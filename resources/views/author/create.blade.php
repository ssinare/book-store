@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">New Author</div>
               <div class="card-body">
                   <div class="list-block">
                    <form action="{{route('author.store')}}" method="post" enctype="multipart/form-data">                       
                            <div class="form-group" style="margin: 10px; font-style: italic">
                                <label>   Name: </label>
                                <input type="text" name="author_name" class="form-control" value="{{old('author_name')}}">
                                <small class="form-text text-muted">   Enter new author's name</small>
                            </div>
                             <div class="form-group" style="margin: 10px; font-style: italic">
                                <label>   Surame: </label>
                                <input type="text" name="author_surname" class="form-control" value="{{old('author_surname')}}">
                                <small class="form-text text-muted">   Enter new author's surname</small>
                            </div>
                            <div class="form-group" style="margin: 10px; font-style: italic">
                                <label>   About: </label>
                                <textarea type="text" name="author_about" id="summernote" class="form-control" >{{old('author_about')}}</textarea>
                                <small class="form-text text-muted">   Enter info about the author</small>
                            </div>
                            <div class="form-group" style="margin: 10px; font-style: italic">
                                <label>   Photo: </label>
                                <input type="file" name="author_photo" class="form-control">
                                <small class="form-text text-muted">   Author's photo</small>
                            </div>
                
                            <div class="form-group" style="margin: 10px">                         
                                <button class="btn btn-light" type="submit" >Add new</button>                            
                            </div> 
                            @csrf                        
                    </form>
                   </div>
               </div>
           </div>
       </div>
   </div>
</div>


@endsection


@section('title') New Author @endsection