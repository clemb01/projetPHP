
@if(count($commentaires) > 0)
<h3>Critiques</h3>
@foreach( $commentaires as $commentaire)
<div class="card">
    <div class="card-body">
        <p class="card-text">{{$commentaire->Fk_User_Id()}}   <small>{{$commentaire->Date()}}</small></p>
        <p class="card-text">{{$commentaire->Contenu()}}</p>
        <!-- <small class="text-muted">Ecrit par <a href="/user/@comm.Username/profile" style="text-decoration: none;"><span class="font-weight-bold">@(Context.User.Identity.Name == comm.Username ?"You": comm.Username)</span></a> le @comm.Date.ToShortDateString() @comm.Date.ToShortTimeString()</small> -->
    </div>
</div>
<br />
@endforeach
@endif
