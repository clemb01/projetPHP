@extends('shared.layout')

@section('title', 'recherche titre')

@section('content')
<div class="jumbotron">
    <form action="/advancedsearch" method="get">
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="query">Recherche</label>
                <input type="text" class="form-control" id="query" name="query" placeholder="Film" value="{{ $model->Query() }}">
            </div>
            <div class="form-group col-md-5">
                <label for="release_year">Année de sortie</label>
                <input type="text" class="form-control" id="release_year" name="releaseYear" value="{{ $model->ReleaseYear() }}">
            </div>
            <div class="form-group col-md-2">
                <button type="submit" class="btn btn-primary" style="margin-top: 32px;">Recherche avancée</button>
            </div>
        </div>
    </form>
    <h1 class="display-4">Nombre de résultats: {{ $model->Total_results() }}</h1>
    <div class="text-center justify-content-center">
        @include('partial.pagination', ['model' => $model])
    </div>
    <hr class="my-4">
    <div id="search-container">
        @if ($model->Results())
            <div class="row" style="justify-content: space-evenly;">
            @foreach ($model->Results() as $result)
                @include('partial.movieCard', ['model' => $result])
            @endforeach
    </div>
    <hr class="my-4">
    <div class="text-center justify-content-center">
        @include('partial.pagination', ['model' => $model])
    </div>
        @else
    <p>
        Aucun résultat n'a été trouvé
    </p>
        @endif
    </div>
</div>
@endsection