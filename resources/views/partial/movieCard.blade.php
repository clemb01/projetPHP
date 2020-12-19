<?php
$url = "http://image.tmdb.org/t/p/w220_and_h330_face" . $model->Poster_path();

    if($model->Release_date())
    {
        $dateArray = date_parse($model->Release_date());

        $date = ($dateArray['day'] < 10 ? "0" . $dateArray['day'] : $dateArray['day']) . "/";
        $date .= ($dateArray['month'] < 10 ? "0" . $dateArray['month'] : $dateArray['month']) . "/";
        $date .= $dateArray['year'];
    }
?>

<div class="card flex-wrap" style="width: 220px; margin-right: 1px; margin-bottom: 1px;">
    <a class="card-img-top" href="movie/{{ $model->Id() }}" title="{{ $model->Title() }}">
        <img src="{{ $url }}" onerror="this.onerror = null; this.src='https://www.themoviedb.org/assets/2/v4/glyphicons/basic/glyphicons-basic-38-picture-grey-c2ebdbb057f2a7614185931650f8cee23fa137b93812ccb132b9df511df1cfac.svg'" class="thumbnail" />
    </a>
    <div class="card-body" style="padding: 0.1rem 0 0 0.25rem;">
        <h5 class="card-title card-custom"><a class="text-decoration-none font-weight-bold" style="color: black;" href="movie/{{ $model->Id() }}" title="{{ $model->Title() }}">{{ $model->Title() }}</a></h5>
        <small class="card-text align-bottom">{{ $model->Release_date() ? $date : "Date de sortie non renseignée" }}</small>
    </div>
</div>