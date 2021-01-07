@if(count($commentaires) > 0)
<h3>Critiques</h3>
@foreach( $commentaires as $commentaire)
<div class="card mb-3">
    <div class="card-body">
        <div class="row no-gutters">
            <div class="col-md-10"> 
            @if(str_contains($commentaire->Login(),'UtilisateurSupprimé'))
                <p class="card-text"><strong>Utilisateur Supprimé</strong> <small>{{$commentaire->Date()}}</small></p>
                <p class="card-text">{{$commentaire->Contenu()}}</p>
            @else
                <p class="card-text"><strong><a href="/profil/{{$commentaire->Login()}}">{{$commentaire->Login()}}</a></strong> <small>{{$commentaire->Date()}}</small></p>
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
