@extends('layouts.app')

@section('content')
    <h2>{{$recipe->title}}</h2>
    <small>Created on {{$recipe->created_on}}</small>
    <div>
        {!!$recipe->body!!}
    </div>
@endsection