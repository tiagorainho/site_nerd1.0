@extends('inc.base')
@section('content')
        <h1>Edit Item</h1>

        {!!Form::open(['action'=>['PostsController@update',$post->id],'method'=>'POST'])!!}
        <div class="form-group">
            {{Form::label('name','Name')}}
            {{Form::text('name',$post->name,['class'=>'form-control','placeholder'=>'Name'])}}            
        </div>
        <div class="form-group">
            {{Form::label('notes','Notes')}}
            {{Form::text('notes',$post->note,['class'=>'form-control','placeholder'=>'Notes'])}}            
        </div>
        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
        {!!Form::close()!!}
    </div>
@endsection
    