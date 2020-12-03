@extends('shared.layout')

@section('title', 'movie titre')

@section('content')
<div class="jumbotron">
    <img src="http://image.tmdb.org/t/p/w220_and_h330_face{{ $model->poster_path }}" onerror="this.onerror = null; this.src='https://www.themoviedb.org/assets/2/v4/glyphicons/basic/glyphicons-basic-38-picture-grey-c2ebdbb057f2a7614185931650f8cee23fa137b93812ccb132b9df511df1cfac.svg'" class="thumbnail" />
    <p>{{ $model->overview }}</p>
</div>
@endsection