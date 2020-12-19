@extends('shared.layout')

@section('title', 'Admin')

@section('content')
<div class="jumbotron">
    <h1 class="col-11">Gestion des utilisateurs</h1>
    <form id="searchForm">
        <div class="row">
            <div class="col-1" style="align-self: center;">
                <label>Filtres: </label>
            </div>
            <div class="col-3">
                <input type="text" name="userName" class="form-control" placeholder="Nom utilisateur" value="">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-2">Rechercher</button>
            </div>
        </div>
    </form>
    <div id="utilisateurs">
    </div>
</div>
@endsection

@section('script')
<script type='text/javascript'>
 $(document).ready(function() {
    $.ajax({
		url : "/admin/getusers?page=1&userName=",
		type: "GET"
	}).done(function(result){
        $('#utilisateurs').html(result);
	})
      .fail(function(result){
          console.log(result);
      });

    $('#searchForm').submit(function(event){
        event.preventDefault();
        var form_data = $(this).serialize();
        getUsers(form_data);
    });
  });

  function changePage(page) {
    getUsers($('#searchForm').serialize(), page);
  }

  function editUser(userId, select, page = 1){
    $.ajax({
		url : "/admin/updateuserrole",
		type: "POST",
		data : {
            userId,
            role: select.options[select.selectedIndex].value
        }
	}).done(function(result){
        getUsers($('#searchForm').serialize(), page);
	})
      .fail(function(result){
          console.log(result);
      });
  }

  function getUsers(filter = null, page = 1) {
    value = (filter.split("="))[1];

      $.ajax({
		url : "/admin/getusers",
		type: "GET",
		data : { 
            userName: value,
            page: page
        }
	}).done(function(result){
        $('#utilisateurs').html(result);
	})
      .fail(function(result){
          console.log(result);
      });
  }
</script>
@endsection