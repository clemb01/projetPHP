@extends('shared.layout')

@section('title', $model->getMovie()->title)

<?php
    $movie = $model->getMovie();
    $dateArray = date_parse($movie->release_date);

    $date = ($dateArray['day'] < 10 ? "0" . $dateArray['day'] : $dateArray['day']) . "/";
    $date .= ($dateArray['month'] < 10 ? "0" . $dateArray['month'] : $dateArray['month']) . "/";
    $date .= $dateArray['year'];

    $hour = (int)($movie->runtime / 60) . "h";
    $hour .= ($movie->runtime % 60) . "m";
?>

@section('content')
<div class="jumbotron p-0">
    <div class="header large border first" style="background-image: url('http://image.tmdb.org/t/p/w1920_and_h800_multi_faces{{ $movie->backdrop_path }}');">
        <div style="background-image: linear-gradient(to right, rgba(11.76%, 18.43%, 23.53%, 1.00) 150px, rgba(18.82%, 25.49%, 30.59%, 0.54) 100%);">
            <div style="padding: 2rem 2rem;">
                <div class="row">
                    <div class="col-4">
                        <img src="http://image.tmdb.org/t/p/w500{{ $movie->poster_path }}" style="width: 300px; height: 450px;" onerror="this.onerror = null; this.src='https://www.themoviedb.org/assets/2/v4/glyphicons/basic/glyphicons-basic-38-picture-grey-c2ebdbb057f2a7614185931650f8cee23fa137b93812ccb132b9df511df1cfac.svg'" class="thumbnail" />
                    </div>
                    <div class="col-8">
                        <h1 class="display-4" style="font-size: 36px;">{{ $movie->title }}</h1>
                        <span>
                            {{ $date }} - {{ $hour }}
                            <div id="note_utilisateurs"></div>
                        </span>
                        <p class="lead">Synopsis</p>
                        <p>{{ $movie->overview ? $movie->overview : "Pas de synopsis renseigné" }}</p>
                        <p class="lead">Genres</p>
                        <p>
                            <?php $count = count($movie->genres); ?>
                            @for ($i = 0; $i < $count; $i++)
                                <span style="color: #0366d6; font-weight: bold;">{{ $movie->genres[$i]->name }}</span>
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
    <div style="padding: 2rem 2rem;">
        <div class="container">
            <div class="row">
                <div id="user_rate" class="col-sm border py-3 px-lg-5">
                </div>
                <div class="col-sm border py-3 px-lg-5">
                    <a href="#commentaire" style="font-size: 24px; text-decoration: none;">Voir les commentaires</a>
                </div>
            </div>
        </div>
        @if($model->getTrailer()->results)
        <div id="trailer-container">
            <h2 class="display-4">Trailer</h2>
            <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $model->getTrailer()->results[0]->key }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        <br />
        @endif
        <div>
            <h2 class="display-4">Cast</h2>
            <ul style="margin: 0; padding: 0; display: flex; flex-direction: row; overflow-x: auto;" id="cast-display">
                @if (count($model->getCast()->cast) > 0)
                    @foreach ($model->getCast()->cast as $person)
                        <li style="flex: 0 0 auto;">
                            <div class="card" style="width: 152px; height: auto; margin-right: 1px; margin-bottom: 1px; border:hidden; background-color:#ecf0f1 ;">
                                <img src="http://image.tmdb.org/t/p/w500{{ $person->profile_path }}" style="width: 150px; height: 200px; border-radius: 2.5px 2.5px 0 0; display: block;" onerror="this.onerror = null; this.src='https://www.themoviedb.org/assets/2/v4/glyphicons/basic/glyphicons-basic-36-user-female-grey-d9222f16ec16a33ed5e2c9bbdca07a4c48db14008bbebbabced8f8ed1fa2ad59.svg'" />
                                <div class="card-body" style="padding: 0.1rem 0 0 0.25rem;">
                                    <h5 class="card-title card-custom font-weight-bold">{{ $person->name }}</h5>
                                    <p class="card-text align-bottom">{{ $person->character }}</p>
                                </div>
                            </div>
                        </li>
                    @endforeach
                @else
                <h4>Le cast n'a pas été renseigné</h4>
                @endif
            </ul>
        </div>
        <br />
        <div>
            <h2 class="display-4">Commentaires (TODO: Nombre de commentaires)</h2>
            <h3>Ecrire un commentaire</h3>
            <form id="commentaire" action="/movie/commentaire" method="post">
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

@section('script')
<script type='text/javascript'>
 $(document).ready(function() {
    getRate();
    getUserRate();
  });

  function getRate() {
      $.ajax({
        url: "/rate/getrate",
        type: "GET",
        data: { movieId: <?php echo $model->getMovie()->id ?> }
      })
      .done(function(result){
        $('#note_utilisateurs').html(result);
      })
      .fail(function(result){
          console.log(result);
      });
  }

  function getUserRate() {
    $.ajax({
        url: "/rate/getuserrate",
        type: "GET",
        data: { movieId: <?php echo $model->getMovie()->id ?> }
      })
      .done(function(result){
        $('#user_rate').html(result);

        $('#rateForm').submit(function(event){
            event.preventDefault();
            var form_data = $(this).serialize();
            submitForm(form_data);
        });

        $('input[name=rating]').change(function(){
            $('#rateForm').submit();
        });
      })
      .fail(function(result){
          console.log(result);
      });
  }

  function submitForm(form_data) {
      $.ajax({
		url : "/rate/rate",
		type: "POST",
		data : form_data
	}).done(function(result){
        getRate();
        getUserRate();
	})
      .fail(function(result){
          console.log(result);
      });
  }
</script>
@endsection