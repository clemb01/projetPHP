@if (!$model->ReleaseYear())
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
@else
<p>
    @if ($model->Page() > 1)
    <a href="advancedsearch?query={{ $model->Query() }}&releaseYear={{ $model->ReleaseYear() }}&page=1">Début</a> -
    <a href="advancedsearch?query={{ $model->Query() }}&releaseYear={{ $model->ReleaseYear() }}&page={{ $model->Page() > 1 ? $model->Page() - 1 : 1 }}">Précédent</a>
    @endif
    - Page {{ $model->Page() }} -
    @if ($model->Page() < $model->total_pages())
    <a href="advancedsearch?query={{ $model->Query() }}&releaseYear={{ $model->ReleaseYear() }}&page={{ $model->Page() < $model->total_pages() ? $model->Page() + 1 : $model->total_pages() }}">Suivant</a> -
    <a href="advancedsearch?query={{ $model->Query() }}&releaseYear={{ $model->ReleaseYear() }}&page={{ $model->total_pages() }}">Fin</a>
    @endif
</p>
@endif