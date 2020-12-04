@extends('shared.layout')

@section('title', 'movie titre')

<?php
    $dateArray = date_parse($model->release_date);

    $date = ($dateArray['day'] < 10 ? "0" . $dateArray['day'] : $dateArray['day']) . "/";
    $date .= ($dateArray['month'] < 10 ? "0" . $dateArray['month'] : $dateArray['month']) . "/";
    $date .= $dateArray['year'];

    $hour = (int)($model->runtime / 60) . "h";
    $hour .= ($model->runtime % 60) . "m";
?>

@section('content')
<div class="jumbotron p-0">
    <div class="header large border first" style="border-bottom: 1px solid rgba(20.20%, 20.78%, 19.22%, 1.00);
                                                background-image: url('http://image.tmdb.org/t/p/w1920_and_h800_multi_faces{{ $model->backdrop_path }}');
                                                background-position: right -200px top;
                                                background-size: cover;
                                                background-repeat: no-repeat;
                                                width: 100%;
                                                position: relative;
                                                z-index: 1;
                                                color: white; ">
        <div style="background-image: linear-gradient(to right, rgba(11.76%, 18.43%, 23.53%, 1.00) 150px, rgba(18.82%, 25.49%, 30.59%, 0.54) 100%);">
            <div style="padding: 2rem 2rem;">
                <div class="row">
                    <div class="col-4">
                        <img src="http://image.tmdb.org/t/p/w500{{ $model->poster_path }}" style="width: 300px; height: 450px;" onerror="this.onerror = null; this.src='https://www.themoviedb.org/assets/2/v4/glyphicons/basic/glyphicons-basic-38-picture-grey-c2ebdbb057f2a7614185931650f8cee23fa137b93812ccb132b9df511df1cfac.svg'" class="thumbnail" />
                    </div>
                    <div class="col-8">
                        <h1 class="display-4" style="font-size: 36px;">{{ $model->title }}</h1>
                        <p>{{ $date }} - {{ $hour }}</p>
                        <p class="lead">Synopsis</p>
                        <p>{{ $model->overview }}</p>
                        <p class="lead">Genres</p>
                        <p>
                            <?php $count = count($model->genres); ?>
                            @for ($i = 0; $i < $count; $i++)
                                <span style="color: #0366d6; font-weight: bold;">{{ $model->genres[$i]->name }}</span>
                                @if ($i < $count - 1)
                                    , 
                                @endif
                            @endfor
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="padding: 4rem 2rem;">
        <div id="trailer-container">
        </div>
        <br />
        <div>
            <h2 class="display-4">Cast</h2>
            <ul class="scrollmenu" id="cast-display">
            </ul>
        </div>
        <br />
        <div>
            <h2 class="display-4">Commentaires ()</h2>
            <h3>Ecrire un commentaire</h3>
            <form action="/movie/commentaire" method="post">
                <fieldset>
                    <input name="MovieId" value="@Model.id" hidden />
                    <input name="MovieName" value="@Model.title" hidden />
                    <input name="MoviePoster" value="@Model.poster_path" hidden />
                    <div class="form-group">
                        <label for="commentaire">Message</label>
                        <textarea class="form-control" name="Message" id="commentaire" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Valider</button>
                </fieldset>
            </form>
        </div>
    </div>
</div>
@endsection