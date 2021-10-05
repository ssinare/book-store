{{-- @extends('book.show') --}}
@extends('layouts.app')

@section('footer-content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">New Comment</div>
               <div class="card-body">
                <div class="list-block">
                    <form action="{{route('comment.store')}}" method="post">                      
                        <div class="form-group" style="margin: 10px; font-style: italic">
                                <label>   User: </label>
                                <input type="text" name="comment_user" class="form-control" value="{{old('comment_user')}}">
                                <small class="form-text text-muted">   Enter user name</small>
                            </div>
                            <div class="form-group" style="margin: 10px; font-style: italic">
                                <label>   Date: </label>
                                <input type="text" name="comment_surname" class="form-control" value="{{old('comment_surname')}}">
                                <small class="form-text text-muted">   Enter date</small>
                            </div>
                           
                            <div class="form-group" style="margin: 10px; font-style: italic">
                                <label>   Comment: </label>
                                <textarea type="text" name="comment_comment" id="summernote" class="form-control" >{{old('comment_comment')}}</textarea>
                                <small class="form-text text-muted">   Enter comment </small>
                            </div>                      
                        <div class="form-group" style="margin: 10px">                         
                            <button class="btn btn-light" type="submit" >Add</button>                            
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

@section('content') New Comment @endsection
