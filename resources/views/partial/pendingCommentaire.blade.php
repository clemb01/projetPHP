@if (count($model) < 1 )
        <p>Pas de commentaire en attente</p>
@else
    @foreach ($model as $commentaire)
        <div class="card mb-3">
            <div class="row no-gutters">
                <div class="col-md-2">
                    <img src="http://image.tmdb.org/t/p/w500/fvzeghfdizf.png" class="card-img thumbnail">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">Test</h5>
                        <p class="card-text">{{ $commentaire->Contenu() }}</p>
                        {{-- <p class="card-text"><small class="text-muted">Ecris par @Html.DisplayFor(modelItem => item.Username) @Html.DisplayFor(modelItem => item.Date)</small></p>
                        @Html.ActionLink("Valider le commentaire", "valider", new { id = item.Id }) |
                        @Html.ActionLink("Supprimer le commentaire", "delete", new { id = item.Id }) --}}
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif