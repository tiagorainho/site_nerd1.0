@extends('inc.base')
@section('content')


      {!!Form::open(['action'=>['PostsController@search'],'method'=>'POST'])!!}
      <div class="form-group">
          {{Form::text('search','',['class'=>'form-control','placeholder'=>'Search', 'style'=>'max-width:400px'])}}            
      </div>
      {{Form::submit('Search',['class'=>'btn btn'])}}
      {!!Form::close()!!}

      <br>
      <a class="btn btn-primary" href="\pages\create">Create</a>
        @if(count($posts)>0)

          <table class="mt-4">
              <tr>
                <th>ID</th>
                <th>Object</th>
                <th></th>
                <th></th>
              </tr>
            @foreach($posts as $post)
              <tr>
                <td>{{$post->id}}</td>
                <td>{{$post->name}}</td>
                <td style="width:20px"><a href="/pages/{{$post->id}}/edit" class="btn btn-primary">Edit</a></td>
                <td style="width:20px"> 
                {!!Form::open(['action'=>['PostsController@destroy',$post->id],'method'=>'POST','class'=>'pull-right'])!!}
                {{Form::hidden('_method','DELETE')}}
                {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
                {!!Form::close()!!}
                </td>
              </tr>
            @endforeach
          </table>
        @else
            <p style="color:orange">Sem inventario</p>
        @endif
        <br>
        <br>

        
        <br>
        <br>
        <br>
    </div>

@endsection