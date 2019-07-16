@extends('inc.base')
@section('content')

    @foreach($posts as $post)
        <div class="gray-div mt-2">  
            <h4>{{$post->name}}</h4>
        </div>
    @endforeach

@endsection