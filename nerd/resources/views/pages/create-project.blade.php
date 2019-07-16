@extends('inc.base')
@section('content')
        <h1>Create Project</h1>

        {!!Form::open(['action'=>'ProjectController@store','method'=>'POST'])!!}
        <div class="form-group">
            {{Form::label('name','Name')}}
            {{Form::text('name','',['class'=>'form-control','placeholder'=>'Name'])}}            
        </div>
        <div class="form-group">
            {{Form::label('notes','Objective')}}
            {{Form::text('notes','',['class'=>'form-control','placeholder'=>'Objective'])}}            
        </div>
        {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
        {!!Form::close()!!}
    </div>
@endsection
    