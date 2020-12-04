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
        <div class="card flex-wrap" style="width: 152px; margin-right: 1px; margin-bottom: 1px;">
        <a class="card-img-top" href="movie/{{ $result->id }}" title="{{ $result->poster_path }}"><img src="http://image.tmdb.org/t/p/w500{{ $result->poster_path }}" class="thumbnail" onerror="this.onerror=null; this.src='https://www.themoviedb.org/assets/2/v4/glyphicons/basic/glyphicons-basic-38-picture-grey-c2ebdbb057f2a7614185931650f8cee23fa137b93812ccb132b9df511df1cfac.svg'" /></a>
            <div class="card-body" style="padding: 0.1rem 0 0 0.25rem;">
                <h5 class="card-title card-custom"><a class="text-decoration-none font-weight-bold" style="color: black;" href="movie/{{ $result->id }}" title="{{ $result->title }}">{{ $result->title }}</a></h5>
                <p class="card-text">{{ $result->release_date }}</p>
            </div>
        </div>
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