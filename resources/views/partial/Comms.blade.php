@if(count($commentaires) > 0)
<h3>Critiques</h3>
@foreach( $commentaires as $commentaire)
<div class="card mb-3">
    <div class="card-body">
        <div class="row no-gutters">
            @if(!$isMoviepage)
            <div class="col-md-2">
                <a href="/movie/{{ $commentaire->FilmId() }}"><img src="http://image.tmdb.org/t/p/w500{{ $commentaire->Film_logo() }}" class="card-img thumbnail" style="width: 110px;"></a>
            </div>
            @endif
            <div class="col-md-8"> 
            @if($isMoviepage && str_contains($commentaire->Login(),'UtilisateurSupprimé'))
                <p class="card-text"><strong>Utilisateur Supprimé</strong> <small>{{$commentaire->Date()}}</small></p>
                <p class="card-text">{{$commentaire->Contenu()}}</p>
            @else
                <p class="card-text">
                    @if($isMoviepage)
                    <strong>
                        <a href="/profil/{{$commentaire->Login()}}">{{$commentaire->Login()}}</a>
                    </strong>
                    @else
                    <strong>
                        <a href="/movie/{{$commentaire->FilmId()}}">{{$commentaire->Film_titre()}}</a>
                    </strong><br />
                    @endif
                <small>{{$commentaire->Date()}}</small></p>
                <p class="card-text">{{$commentaire->Contenu()}}</p>
            @endif
            </div>
            @if($isMoviepage)
            @if(!empty($_SESSION['user']))
            @if($_SESSION['user']->getRole() === "admin" || $_SESSION['user']->getRole() === "modo" || $_SESSION['user']->getLogin() === $commentaire->Login())
            <div class="col-md-1">
                <div class="form-group">
                    <button class="btn btn-primary" href="#" onclick="showModalComms({{$commentaire->Id()}})" ><img src='\crayonPHP.png' style='width: 25px; height: 25px;'/></button> 
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <button class="btn btn-secondary" href="#" onclick="showModalCommsSupp({{$commentaire->Id()}})"><img src='\poubellePHP.png' style='width: 25px; height: 25px;'/></button>
                </div>
            </div>
            @endif
            @endif
            @endif
        </div>
    </div>
</div>
<br />
@endforeach
@endif