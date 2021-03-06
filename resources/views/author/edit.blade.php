@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Author edit</div>
               <div class="card-body">
                    <div class="list-block">
                    <form action="{{route('author.update', $author)}}" method="post" enctype="multipart/form-data">                        
                         <div class="form-group" style="margin: 10px; font-style: italic">
                                <label>   Name: </label>
                                <input type="text" name="author_name" class="form-control" value="{{old('author_name', $author->name)}}">
                                <small class="form-text text-muted">   Edit author's name</small>
                            </div>
                             <div class="form-group" style="margin: 10px; font-style: italic">
                                <label>   Surame: </label>
                                <input type="text" name="author_surname" class="form-control" value="{{old('author_surname', $author->surname)}}">
                                <small class="form-text text-muted">   Edit author's surname</small>
                            </div>
                            <div class="form-group" style="margin: 10px; font-style: italic">
                                <label>   About: </label>
                                <textarea type="text" name="author_about" id="summernote" class="form-control" >{{old('author_about', $author->about)}}</textarea>
                                <small class="form-text text-muted">   Edit info about the author</small>
                            </div>
                            
                             <div class="form-group" style="margin: 10px; font-style: italic">
                                <label>   Photo: </label>
                                <div class="img" style="margin: 10px; font-style: italic">
                                    @if ($author->photo)
                                    <img src="{{$author->photo}}">
                                    @else   <img src="{{asset('img/no-image.png')}}">
                                    @endif
                                </div>
                                <input type="checkbox" class="" name="author_photo_delete" id="df"><label for="df">Delete photo</label> 
                                <input type="file" name="author_photo" class="form-control">
                                <small class="form-text text-muted">   Author's photo</small>
                            </div>
                        
                        <div class="form-group" style="margin: 10px">                         
                            <button class="btn btn-light" type="submit" >Update Author</button>                            
                        </div> 
                            @csrf                       
                    </form>
               </div>
           </div>
       </div>
   </div>
</div>


@endsection

@section('title') Author edit @endsection