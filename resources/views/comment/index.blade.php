@extends('layouts.app')

@section('footer-content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Comments List</div>

               <div class="card-body">
                   <div class="mb-3">{{$comments->links()}}</div>
                   <ul class="list-group">
                    @foreach ($comments as $comment)
                    <li class="list-group-item">
                        <div class="list-block" >
                            <div class="list-block_content"style="margin: 10px; font-style: italic">
                                <div>
                                    <span> <b>{{$comment->date}} {{$comment->name}}</b> </span> 
                                    <div>{{$comment->comment}}</div>      
                                </div>
                
                            </div>
                            <div class="list-block_button">
        
                                <form method="POST" action="{{route('comment.destroy', $comment)}}">
                                <button type="submit" class="btn btn-secondary" >Delete</button>
                                @csrf
                                </form>
                            </div>
                        </div>
                    </li>      
                    @endforeach
                   </ul>
                    <div class="m-2">{{$comments->links()}}</div> 
               </div>
           </div>
       </div>
   </div>
</div>
@endsection


@section('content') Comments List @endsection
