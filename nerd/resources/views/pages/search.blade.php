@extends('inc.base')
@section('content')

    
    <form action="/pages/search" method="post">
        <div class="input-group">
            <input type="search" name="search" class="form-control" placeholder="Search">
            <span class="input-group-prepend">
                <button type="submit" class="btn btn-primary"><Search></button>
            </span>
        <div>
    </form>

@endsection