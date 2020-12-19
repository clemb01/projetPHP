@extends('shared.layout')

@section('title', 'test titre')

@section('content')
<div class="jumbotron"><h1 class="display-4">Derniers films</h1>
    <hr class="my-4">
    <div class="row" style="justify-content: space-evenly;">
    @foreach($model->Results() as $result)
        @include('partial.movieCard', ['model' => $result])
    @endforeach
    </div>
</div>
@endsection