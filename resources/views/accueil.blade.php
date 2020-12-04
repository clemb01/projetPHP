@extends('shared.layout')

@section('title', 'test titre')

@section('content')
<div class="jumbotron">
<?php
    foreach($model->results as $result)
    {
        $url = "http://image.tmdb.org/t/p/w220_and_h330_face" . $result->poster_path;
        ?>
            <a class="card-img-top" href="movie/{{ $result->id }}" title="{{ $result->title }}">
                <img src="<?php echo $url; ?>" onerror="this.onerror = null; this.src='https://www.themoviedb.org/assets/2/v4/glyphicons/basic/glyphicons-basic-38-picture-grey-c2ebdbb057f2a7614185931650f8cee23fa137b93812ccb132b9df511df1cfac.svg'" class="thumbnail" />
            </a>
            <div class="card-body" style="padding: 0.1rem 0 0 0.25rem;">
                <h5 class="card-title card-custom"><a class="text-decoration-none font-weight-bold" style="color: black;" href="movie/{{ $result->id }}" title="{{ $result->title }}">{{ $result->title }}</a></h5>
                <p class="card-text align-bottom">{{ $result->release_date }}</p>
            </div>
        <?php
    }
?>
</div>
@endsection