@extends('inc.base')
@section('content')

    <div>
        <small>Created by {{$post->user->name}}</small>
        {!!Form::open(['action'=>['ProjectController@update',$post->id],'method'=>'POST'])!!}
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card <!--shadow--> h-100">
                    <div id="slide-right-delay" class="card-body">
                    <img src="/images/projects/{{$post->img}}" width="300">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card <!--shadow--> h-100">
                    <div id="slide-right-delay" class="card-body">
                        <div class="form-group">
                            {{Form::label('name','Project Name')}}
                            {{Form::text('name',$post->name,['class'=>'form-control','placeholder'=>'Name'])}}            
                        </div>
                        <div class="form-group">
                            {{Form::label('notes','Information')}}
                            {{Form::textarea('notes',$post->note,['class'=>'form-control','placeholder'=>'Notes'])}}            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
        {!!Form::close()!!}
    </div>

@endsection