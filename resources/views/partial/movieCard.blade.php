<?php
$url = "http://image.tmdb.org/t/p/w220_and_h330_face" . $model->poster_path;
?>

<div class="card flex-wrap" style="width: 220px; margin-right: 1px; margin-bottom: 1px;">
    <a class="card-img-top" href="movie/{{ $model->id }}" title="{{ $model->title }}">
        <img src="{{ $url }}" onerror="this.onerror = null; this.src='https://www.themoviedb.org/assets/2/v4/glyphicons/basic/glyphicons-basic-38-picture-grey-c2ebdbb057f2a7614185931650f8cee23fa137b93812ccb132b9df511df1cfac.svg'" class="thumbnail" />
    </a>
    <div class="card-body" style="padding: 0.1rem 0 0 0.25rem;">
        <h5 class="card-title card-custom"><a class="text-decoration-none font-weight-bold" style="color: black;" href="movie/{{ $model->id }}" title="{{ $model->title }}">{{ $model->title }}</a></h5>
        <p class="card-text align-bottom">{{ $model->release_date }}</p>
    </div>
</div>