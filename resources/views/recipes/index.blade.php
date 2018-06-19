@extends('layouts.app')

@section('content')
    <h2>Recipes</h2>
    @if(count($recipes) > 0)
        @foreach($recipes as $recipe)
            <div class = "card card-body bg-light">
                <h3 class = "card-title">{{$recipe->title}}</h3>
                <small>Created on {{$recipe->created_at}}</small>
            </div>
        @endforeach
    @else
        <p>No recipes found</p>
    @endif
@endsection