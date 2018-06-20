@extends('layouts.app')

@section('content')
    <h2>{{$recipe->title}}</h2>
    <small>Created on {{$recipe->created_on}}</small>
    <div>
        {!!$recipe->body!!}
    </div>
    <hr>
    <a href = "/recipes/{{$recipe->id}}/edit" class = "btn btn-primary">Edit</a>

    {!!Form::open(['action' => ['RecipesController@destroy', $recipe->id], 'method' => 'POST', 'class' => 'float-right'])!!}
        {{Form::hidden('_method', 'DELETE')}}
        {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
    {!!Form::close()!!}
    @endsection