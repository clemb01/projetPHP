@extends('shared.layout')

@section('title', 'Formulaire')

@section('content')
<div class="jumbotron">
    <h1 class="col-11">Création de votre compte</h1>
    <form id="FormUser" class="Jumbotron" action='/formulaireUser/register' method="post">
        <div class="row">
            <div class="col-md-3 field-label-responsive">
                    <label class="">Pseudo</label>
            </div>
            <div class="col-md-6 field-label-responsive">
                <div class="form-group">
                    <input type="text" class="form-control" onchange="CheckLogin()" placeholder="xX-DarkSasuke-Xx" id="pseudo" name="pseudo" required autofocus>
                </div>
            </div>
            <div class="col-md-3 field-label-responsive">
                <div>
                    <span class="text-danger">
                        <p id="messagePseudo"></p>
                    </span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 field-label-responsive">
                <label class="">Prénom</label>
            </div>
            <div class="col-md-6 field-label-responsive">
                <div class="form-group">
                    <input type="text" class="form-control" value="" id="prenom" name="prenom" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 field-label-responsive">
                <label class="">Nom</label>
            </div>
            <div class="col-md-6 field-label-responsive">
                <div class="form-group">
                    <input type="text" class="form-control" value="" id="nom" name="nom" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 field-label-responsive">
                <label class="">Date de naissance</label>
            </div>
            <div class="col-md-6 field-label-responsive">
                <div class="form-group">
                    <input type="date" class="form-control" value="" id="dateNaissance" name="dateNaissance" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 field-label-responsive">
                <label class="">Mot de passe</label>
            </div>
            <div class="col-md-6 field-label-responsive">
                <div class="form-group">
                    <input type="password" class="form-control" onkeyup="CheckPassword()" id="password" name="password" required>
                </div>
            </div>
            <div class="col-md-3 field-label-responsive">
                <div>
                    <span class="text-danger">
                        <p id="messagePassword"></p>
                    </span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 field-label-responsive">
                <label class="">Confirmation mot de passe</label>
            </div>
            <div class="col-md-6 field-label-responsive">
                <div class="form-group">
                    <input type="password" class="form-control" onkeyup="CheckConfirmPassword()" id="confirmPassword" name="confirmPassword" required>
                </div>
            </div>
            <div class="col-md-3 field-label-responsive">
                <div>
                    <span class="text-danger">
                        <p id="messageConfirmPassword"></p>
                    </span>
                </div>
            </div>
        </div>
        <p>
            <button type="submit" class="btn btn-success" id="RegisterButton" disabled>S'inscrire</button>
        </p>
    </form>
    </div>
</div>
@endsection

@section('script')
<script type='text/javascript'>
function CheckConfirmPassword(){
    if(document.getElementById('confirmPassword').value == "")
    {
        document.getElementById('messageConfirmPassword').innerHTML = 'Le mot de passe ne peut être vide !';
        document.getElementById('RegisterButton').setAttribute("disabled","true");
        
    }
    else if(VerifPassword() == true)
    {
        document.getElementById('messageConfirmPassword').innerHTML = '';
        document.getElementById('messagePassword').innerHTML = '';
        document.getElementById('RegisterButton').removeAttribute("disabled");
    }
    else
    {
        document.getElementById('messageConfirmPassword').innerHTML = 'Erreur pas le même mot de passe !';
        document.getElementById('RegisterButton').setAttribute("disabled","true");
    }
}

function CheckPassword(){
    if(document.getElementById('password').value == "")
    {
        document.getElementById('messagePassword').innerHTML = 'Le mot de passe ne peut être vide !';
        document.getElementById('RegisterButton').setAttribute("disabled","true");
    }
    else if(VerifPassword() == true)
    {
        document.getElementById('messagePassword').innerHTML = '';
        document.getElementById('messageConfirmPassword').innerHTML = '';
        document.getElementById('RegisterButton').removeAttribute("disabled");
    }
    else
    {
        document.getElementById('messagePassword').innerHTML = 'Erreur pas le même mot de passe !';
        document.getElementById('RegisterButton').setAttribute("disabled","true");
    }
    
}

function VerifPassword(){
    if(document.getElementById('password').value == document.getElementById('confirmPassword').value)
    {
        return true;
    }
    else
    {
        return false;
    }
}

function CheckLogin() {
      $.ajax({
		url : "/formulaireUser/checkLoginExist",
        type: "GET",
        data: { "pseudo": document.getElementById('pseudo').value }
	}).done(function(result){
        if(result == 'true')
        {
            document.getElementById('messagePseudo').innerHTML = 'Le login existe deja !';
            document.getElementById('ModifButton').setAttribute("disabled","true");
        }
        else
        {
            document.getElementById('ModifButton').removeAttribute("disabled");
        }
	})
      .fail(function(result){
      });
  }
</script>
@endsection