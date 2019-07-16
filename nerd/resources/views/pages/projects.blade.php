@extends('inc.base')
@section('content')

    {!!Form::open(['action'=>['ProjectController@search'],'method'=>'POST'])!!}
    <div class="form-group">
        {{Form::text('search','',['class'=>'form-control','placeholder'=>'Search', 'style'=>'max-width:400px'])}}            
    </div>
    {{Form::submit('Search',['class'=>'btn btn'])}}
    {!!Form::close()!!}


    <a class="btn btn-primary mb-4 mt-4" href="/create-project">Create</a>

    @if(count($posts)>0)
        <div class="row">
        @foreach($posts as $post)
                <div class="col-md-6 col-lg-4 mb-5">
                <div class="card border-0"><a href="/projects/{{$post->id}}">
                    <img src="/images/projects/{{$post->img}}" class="card-img-top scale-on-hover" width="120"></a>
                        <div class="card-body">
                            <h2 style="color:grey">{{$post->name}}</h2>
                        </div>
                    </div>
                </div>
        @endforeach
        
    @else
        <h1>No Projects found</h1>
    @endif
    
@endsection