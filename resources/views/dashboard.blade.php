@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h3>Your Recipes</h3>
                    @if(count($recipes) > 0)
                        <table class = "table table-striped">
                            <tr>
                                <th>Title</th>
                                <th></th>
                                <th></th>
                            </tr>
                            @foreach($recipes as $recipe)
                                <tr>
                                    <th>{{$recipe->title}}</th>
                                    <th><a href = "/recipes/{{$recipe->id}}/edit" class = "btn btn-primary float-right">Edit</a></th>
                                    <th style = "width: 50px">
                                        {!!Form::open(['action' => ['RecipesController@destroy', $recipe->id], 'method' => 'POST', 'class' => 'float-right'])!!}
                                            {{Form::hidden('_method', 'DELETE')}}
                                            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                        {!!Form::close()!!}
                                    </th>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <p>You have no recipes published yet!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
