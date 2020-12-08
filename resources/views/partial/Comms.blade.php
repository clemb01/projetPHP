
@foreach( $commentaires as $commentaire)
<!-- {{$commentaire->Fk_User_Id()}}   {{$commentaire->Date()}}
<br />
{{$commentaire->Contenu()}}
<br />
<br /> -->
<div class="card">
    <div class="card-body">
        <p class="card-text">{{$commentaire->Fk_User_Id()}}   {{$commentaire->Date()}}</p>
        <p class="card-text">{{$commentaire->Contenu()}}</p>
        <!-- <small class="text-muted">Ecrit par <a href="/user/@comm.Username/profile" style="text-decoration: none;"><span class="font-weight-bold">@(Context.User.Identity.Name == comm.Username ?"You": comm.Username)</span></a> le @comm.Date.ToShortDateString() @comm.Date.ToShortTimeString()</small> -->
    </div>
</div>
<br />
@endforeach
