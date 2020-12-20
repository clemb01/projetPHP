@if (count($model) < 1 )
        <p>Pas de commentaire en attente</p>
@else
    @foreach ($model as $commentaire)
        <div class="card mb-3">
            <div class="row no-gutters">
                <div class="col-md-2">
                    <a href="/movie/{{ $commentaire->FilmId() }}"><img src="http://image.tmdb.org/t/p/w500{{ $commentaire->Film_logo() }}" class="card-img thumbnail" style="width: 110px;"></a>
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <a href="/movie/{{ $commentaire->FilmId() }}"><h5 class="card-title">{{ $commentaire->Film_titre() }}</h5></a>
                        @if($commentaire->ValideModif())
                        <p class="card-text"><small class="text-muted">Ancien commentaire</small></p>
                        <p class="card-text">{{ $commentaire->Contenu() }}</p>
                        <p class="card-text"><small class="text-muted">Nouveau commentaire</small></p>
                        @endif
                        <p class="card-text">{{ $commentaire->NouveauContenu() }}</p>
                    <p class="card-text"><small class="text-muted">Ecris par <strong>{{ $commentaire->Login() }}</strong> le {{ $commentaire->Date() }}</small></p>
                    </div>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary" onclick="accepterCommentaire({{ $commentaire->Id() }}, {{ $commentaire->ValideModif() ? 'true' : 'false' }});">Accepter</button>
                    <button class="btn btn-secondary" onclick="refuserCommentaire({{ $commentaire->Id() }}, {{ $commentaire->ValideModif() ? 'true' : 'false' }});">Refuser</button>
                </div>
            </div>
        </div>
    @endforeach
@endif