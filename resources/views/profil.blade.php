@extends('shared.layout')

@section('title', 'profil')

@section('content')
<div class="jumbotron">
    <h1 class="col-11">Profil de {{$user->getLogin()}}</h1>
        <div class="row">
            <div class="col-md-3 field-label-responsive">
                    <label class="">Pseudo</label>
            </div>
            <div class="col-md-6 field-label-responsive">
                <label class="">{{$user->getLogin()}}</label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 field-label-responsive">
                <label class="">Prénom</label>
            </div>
            <div class="col-md-6 field-label-responsive">
                <label class="">{{$user->getPrenom()}}</label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 field-label-responsive">
                <label class="">Nom</label>
            </div>
            <div class="col-md-6 field-label-responsive">
                <label class="">{{$user->getNom()}}</label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 field-label-responsive">
                <label class="">Date de naissance</label>
            </div>
            <div class="col-md-6 field-label-responsive">
                <label class="">{{$user->getDateN()}}</label>
            </div>
        </div>
        @if(isset($_SESSION['user']) && $user->getLogin() == $_SESSION['user']->getLogin())
        <div class="row">
                      
            <div class="col-md-3 field-label-responsive">   
                <button data-toggle='modal' data-target='#Supprimer' type="submit" class="btn btn-danger">Supprimer</button>
                <a href="/modifUser" class="btn btn-success">Modifier</a>
            </div>
            <div class="modal fade" id="Supprimer" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="color: red;">
                        <h2 class="modal-title">Suppression du Compte</h2>
                    </div>
                    <div class="modal-body" id="ConfirmationSuppr">
                        <form id="SupprProfil" class="Jumbotron" action='profil/supprimerprofil' method="post">
                            <p><label class=""><strong>Êtes-vous sûr de vouloir supprimer votre compte ?</strong></label></p>
                            <p>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
            </div>            
        </div>
        @endif
        <hr />
        <div id="user_comms">

        </div>
    </div>
</div>
@endsection

@section('script')
<script type='text/javascript'>
$(document).ready(function()
{
    var userId = {{ $user->getId() }}
    $.ajax({
		url : "/comms/userCommentaires",
        type: "GET",
        data: { "userId": userId }
	}).done(function(result){
        document.getElementById('user_comms').innerHTML = result;
	})
      .fail(function(result){
          console.log(result);
      });

    $("#SupprProfil").submit(function(event)
    {
        event.preventDefault();
        AlertSuppr();
    })
});

</script>
@endsection