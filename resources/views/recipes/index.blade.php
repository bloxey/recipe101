@extends('layouts.app')

@section('content')
    <h1>All Recipes</h1>
    @if(count($recipes) > 0)
        @foreach($recipes as $recipe)
            <div class = "card card-body bg-light">
            <h3 class = "card-title"><a href = "/recipes/{{$recipe->id}}">{{$recipe->title}}</a></h3>
                <small>Created on {{$recipe->created_at}}</small>
            </div>
        @endforeach
        {{$recipes->links()}}
    @else
        <p>No recipes found</p>
    @endif
@endsection