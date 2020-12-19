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
                        <p class="card-text">{{ $commentaire->Contenu() }}</p>
                    <p class="card-text"><small class="text-muted">Ecris par <strong>{{ $commentaire->Login() }}</strong> le {{ $commentaire->Date() }}</small></p>
                    </div>
                </div>
                <div class="col-md-2">
                    <form method="post" action="/admin/acceptercommentaire">
                        <input name="commentaireId" value="{{ $commentaire->Id() }}" hidden/>
                        <div class="form-group">
                            <button class="btn btn-primary">Accepter</button>
                            <button class="btn btn-secondary" formaction="/admin/refusercommentaire">Refuser</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endif