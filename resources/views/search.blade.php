@extends('shared.layout')

@section('title', 'recherche titre')

@section('content')
<div class="jumbotron">
    <h1 class="display-4">Résultat pour "{{ $model->getQuery() }}"</h1>
    <h1 class="display-4">Nombre de résultats: "{{ $model->getResult()->total_results }}"</h1>
    <hr class="my-4">
    <div id="search-container">
        @if ($model->getResult()->results)
            <div class="row justify-content-start">
            @foreach ($model->getResult()->results as $result)
                @include('partial.movieCard', ['model' => $result])
            @endforeach
    </div>
    <hr class="my-4">
    <div class="text-center justify-content-center">
        <p>
            @if ($model->getResult()->page > 1)
            <a href="search?query={{ $model->getQuery() }}&page=1">Début</a> -
            <a href="@previousPageUrl">Précédent</a>
            @endif
            - Page {{ $model->getResult()->page }} -
            @if ($model->getResult()->page < $model->getResult()->total_pages)
            <a href="@nextPageUrl">Suivant</a> -
            <a href="search?query={{ $model->getQuery() }}&page={{ $model->getResult()->total_pages }}">Fin</a>
            @endif
        </p>
    </div>
        @else
    <p>
        Aucun résultat n'a été trouvé
    </p>
        @endif
    </div>
</div>
@endsection