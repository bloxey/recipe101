@extends('layouts.app')

@section('content')
    <h1>All Recipes</h1>
    @if(count($recipes) > 0)
        @foreach($recipes as $recipe)
            <div class = "card card-body bg-light">
                <div class = "row">
                    <div class = "col-md-4 col-sm-4">
                        <img style = "width: 100%;" src = "/storage/cover_images/{{$recipe->cover_img}}"/>
                    </div>
                    <div class = "col-md-8 col-sm-8">
                        <h3 class = "card-title"><a href = "/recipes/{{$recipe->id}}">{{$recipe->title}}</a></h3>
                        <small>Created on {{$recipe->created_at}} by {{$recipe->user->name}}</small>
                    </div>
                </div>
            </div>
        @endforeach
        {{$recipes->links()}}
    @else
        <p>No recipes found</p>
    @endif
@endsection