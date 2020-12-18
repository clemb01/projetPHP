<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/[accueil]', 'MovieController@getFilms');
$router->post('/accueil/login', 'CookieController@loginAction');
$router->get('/accueil/logout', 'CookieController@SeDeconnecter');
$router->get('/movie/{id}', 'MovieController@getFilm');
$router->get('/search', 'MovieController@search');

$router->get('/rate/getrate', 'NoteController@getMovieRate');
$router->get('/rate/getuserrate', 'NoteController@getUserMovieRate');
$router->post('/rate/rate', 'NoteController@rateMovie');

$router->post('/comms/commentaire', 'CommentaireController@saveComms');

$router->get('/admin', 'AdminController@getAccueilAdmin');
$router->get('/admin/getpendingcommentaire', 'AdminController@getPendingCommentaire');
