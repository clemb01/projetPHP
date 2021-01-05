@extends('shared.layout')

@section('title', 'recherche titre')

@section('content')
<div class="jumbotron">
    <h1 class="display-4">Résultat pour "{{ $model->Query() }}"</h1>
    <h1 class="display-4">Nombre de résultats: "{{ $model->Total_results() }}"</h1>
    <div class="text-center justify-content-center">
        <p>
            @if ($model->Page() > 1)
            <a href="search?query={{ $model->Query() }}&page=1">Début</a> -
            <a href="search?query={{ $model->Query() }}&page={{ $model->Page() > 1 ? $model->Page() - 1 : 1 }}">Précédent</a>
            @endif
            - Page {{ $model->Page() }} -
            @if ($model->Page() < $model->total_pages())
            <a href="search?query={{ $model->Query() }}&page={{ $model->Page() < $model->total_pages() ? $model->Page() + 1 : $model->total_pages() }}">Suivant</a> -
            <a href="search?query={{ $model->Query() }}&page={{ $model->total_pages() }}">Fin</a>
            @endif
        </p>
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
        <p>
            @if ($model->Page() > 1)
            <a href="search?query={{ $model->Query() }}&page=1">Début</a> -
            <a href="search?query={{ $model->Query() }}&page={{ $model->Page() > 1 ? $model->Page() - 1 : 1 }}">Précédent</a>
            @endif
            - Page {{ $model->Page() }} -
            @if ($model->Page() < $model->total_pages())
            <a href="search?query={{ $model->Query() }}&page={{ $model->Page() < $model->total_pages() ? $model->Page() + 1 : $model->total_pages() }}">Suivant</a> -
            <a href="search?query={{ $model->Query() }}&page={{ $model->total_pages() }}">Fin</a>
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