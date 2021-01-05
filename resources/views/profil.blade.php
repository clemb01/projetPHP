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
        <div class="row">
            <div class="col-md-3 field-label-responsive">
                <button type="submit" class="btn btn-success">Modifier</button>
            </div>
            <form action='profil/gestionprofil' method="post">
                <div class="col-md-3 field-label-responsive">   
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection