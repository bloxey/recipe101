@extends('layouts.app')

@section('content')
    <h2>{{$recipe->title}}</h2>
    <img style = "width: 100%;" src = "/storage/cover_images/{{$recipe->cover_img}}"/>
<small>Created on {{$recipe->created_at}} by {{$recipe->user->name}}</small>
    <div>
        {!!$recipe->body!!}
    </div>
    @auth
        @if(Auth()->user()->id == $recipe->user->id)
            <hr>
            <a href = "/recipes/{{$recipe->id}}/edit" class = "btn btn-primary">Edit</a>

            {!!Form::open(['action' => ['RecipesController@destroy', $recipe->id], 'method' => 'POST', 'class' => 'float-right'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
            {!!Form::close()!!}
        @endif
    @endauth
@endsection