@extends('layouts.app')

@section('content')
    <h1>Edit Recipe</h1>

    {!! Form::open(['action' => ['RecipesController@update', $recipe->id], 'method' => 'POST']) !!}
        <div class = "form-group">
            {{Form::label('title', 'Name')}}
            {{Form::text('title', $recipe->title, ['class' => 'form-control', 'placeholder' => 'e.g. Grannys pancakes'])}}
        </div>
        <div class = "form-group">
            {{Form::label('body', 'Recipe')}}
            {{Form::textarea('body', $recipe->body, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'e.g. Start by mixing flour with baking powder.'])}}
        </div>

        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Publish', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection