function AlertSuppr(form)
{  
    $.ajax({
		url : "/profil/supprimerprofil",
		type: "POST"
	}).done(function(result){
       window.location.href=window.location.origin+"/accueil?suppression=true";
       
	})
      .fail(function(result){
          console.log(result);
      });
}