@extends('shared.layout')

@section('title', 'Accueil')

@section('content')

@if($suppression)
<div id="AlertSuprr">
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Compte supprimé !</strong> Vous ne pourrez plus vous connecter via ce compte.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
</div>
@endif


<div class="jumbotron"><h1 class="display-4">Derniers films</h1>
    @if($model->Total_pages() > 1)
    <div class="text-center justify-content-center">
        <br />
        <p>
            @if ($model->Page() > 1)
            <a href="/accueil?page=1">Début</a> -
            <a href="/accueil?page={{ $model->Page() > 1 ? $model->Page() - 1 : 1 }}">Précédent</a> -
            @endif
            Page {{ $model->Page() }}
            @if ($model->Page() < $model->Total_pages())
            - <a href="/accueil?page={{ $model->Page() < $model->Total_pages() ? $model->Page() + 1 : $model->Total_pages() }}">Suivant</a> -
            <a href="/accueil?page={{ $model->Total_pages() }}">Fin</a>
            @endif
        </p>
    </div>
    @endif
    <hr class="my-4">
    <div class="row" style="justify-content: space-evenly;">
    @foreach($model->Results() as $result)
        @include('partial.movieCard', ['model' => $result])
    @endforeach
    </div>
    @if($model->Total_pages() > 1)
    <div class="text-center justify-content-center">
        <br />
        <p>
            @if ($model->Page() > 1)
            <a href="/accueil?page=1">Début</a> -
            <a href="/accueil?page={{ $model->Page() > 1 ? $model->Page() - 1 : 1 }}">Précédent</a> -
            @endif
            Page {{ $model->Page() }}
            @if ($model->Page() < $model->Total_pages())
            - <a href="/accueil?page={{ $model->Page() < $model->Total_pages() ? $model->Page() + 1 : $model->Total_pages() }}">Suivant</a> -
            <a href="/accueil?page={{ $model->Total_pages() }}">Fin</a>
            @endif
        </p>
    </div>
    @endif
</div>
@endsection