@extends('shared.layout')

@section('title', 'Admin')

@section('content')
<div class="jumbotron">
    <h1 class="col-11">Gestion des commentaires</h1>
    <form id="searchForm">
        <div class="row">
            <div class="col-1" style="align-self: center;">
                <label>Filtres: </label>
            </div>
            <div class="col-3">
                <input type="text" name="userName" class="form-control" placeholder="Nom utilisateur">
            </div>
            <div class="col-3">
                <input type="text" name="movieName" class="form-control" placeholder="Nom du film">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-2">Rechercher</button>
            </div>
        </div>
    </form>
    <div id="commentaires">
    </div>
</div>
@endsection

@section('script')
<script type='text/javascript'>
 $(document).ready(function() {
    getCommentaire();

    $('#searchForm').submit(function(event){
        event.preventDefault();
        var form_data = $(this).serialize();
        getCommentaire(form_data);
    });
  });

  function getCommentaire(filter = null) {
      $.ajax({
		url : "/admin/getpendingcommentaire",
		type: "GET",
		data : filter
	}).done(function(result){
        $('#commentaires').html(result);
	})
      .fail(function(result){
          console.log(result);
      });
  }
</script>
@endsection