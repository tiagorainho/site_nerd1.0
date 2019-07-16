@extends('inc.base')
@section('content')
        <h1>Create Item</h1>

        {!!Form::open(['action'=>'PostsController@store','method'=>'POST'])!!}
        <div class="form-group">
            {{Form::label('name','Name')}}
            {{Form::text('name','',['class'=>'form-control','placeholder'=>'Name'])}}            
        </div>
        <div class="form-group">
            {{Form::label('notes','Notes')}}
            {{Form::text('notes','',['class'=>'form-control','placeholder'=>'Notes'])}}            
        </div>
        {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
        {!!Form::close()!!}
    </div>
@endsection
    