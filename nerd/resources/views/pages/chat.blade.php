@extends('inc.base')
@section('content')
    <h1>Chat</h1>
    <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#newMessage" data-whatever="@mdo">New message</button>
    
    <div class="modal fade" id="newMessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">New message</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <!--
              <form>
                <div class="form-group">
                  <label for="recipient-name" class="col-form-label">Recipient:</label>
                  <input type="text" class="form-control" id="recipient-name">
                </div>
                <div class="form-group">
                    <label for="message-text" class="col-form-label">Message:</label>
                    <textarea class="form-control" id="messageText"></textarea>
                </div>
            </form>-->


                {!!Form::open(['action'=>'ChatController@store','method'=>'POST'])!!}
                <div class="form-group">
                    {{Form::text('messageText','',['class'=>'form control','placeholder'=>'Message'])}}                
                </div>
                <div class="modal-footer">
                {{Form::submit('Send message',['class'=>'btn btn-primary'])}}
                {!!Form::close()!!}
            
              <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Send message</button>-->
              </div>
            </div>
          </div>
        </div>
    </div>
    @if(count($posts)>0)
        @foreach($posts as $post)
        <div class="message body">
            @if($post->user_id == Auth::user()->id)
              <div class="container-message darker"><!--container-message darker-->
                <img src="images/users/person.png" alt="Avatar" class="right">
                <p>{{$post->message}}</p>
                <span class="time-left">{{$post->updated_at}}</span>
            @else
            <div class="container-message"><!--container-message darker-->
                <img src="images/users/person.png" alt="Avatar" >
                <p>{{$post->message}}</p>
                <span class="time-right">{{$post->updated_at}}</span>
            @endif
          </div>
        </div>
            
        @endforeach
    @else
        <h2>No messages</h2>
    @endif
    <script>
    function hideDate(data){
        let info = document.getElementById("show-hide"+data);
        info.style.opacity=0;
    }
    function showDate(data){
        let info = document.getElementById("show-hide"+data);
        info.style.opacity=1;
    }
    hideDate();
    </script>

@endsection
    