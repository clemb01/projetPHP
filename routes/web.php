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
$router->get('/accueil/logout', 'CookieController@logoutAction');

$router->get('/movie/{id}', 'MovieController@getFilm');

$router->get('/search', 'MovieController@search');
$router->get('/advancedsearch', 'MovieController@advancedSearch');

$router->get('/formulaireUser', 'FormulaireUserController@getFormulaire');
$router->post('/formulaireUser/register', 'FormulaireUserController@addUser');
$router->get('/formulaireUser/checkLoginExist', 'FormulaireUserController@checkLoginExist');

$router->get('/modifUser', 'ModifUserController@getModif');
$router->post('/modifUser/Save', 'ModifUserController@updateUser');
$router->get('/modifUser/checkLoginExist', 'ModifUserController@checkLoginExist');

$router->get('/rate/getrate', 'NoteController@getMovieRate');
$router->get('/rate/getuserrate', 'NoteController@getUserMovieRate');
$router->post('/rate/rate', 'NoteController@rateMovie');

$router->post('/comms/commentaire', 'CommentaireController@saveComms');
$router->get('/comms/getCommentaires', 'CommentaireController@getUserMovieComms');
$router->get('/comms/getCommentaire', 'CommentaireController@getUserMovieComm');
$router->post('/comms/Modif', 'CommentaireController@ModifComms');
$router->post('/comms/suppCommentaire', 'CommentaireController@suppComms');
$router->get('/comms/userCommentaires', 'CommentaireController@getAllUserComms');

$router->get('/admin/commentaires', 'AdminController@CommentairesView');
$router->get('/admin/users', 'AdminController@UsersView');
$router->get('/admin/getusers', 'AdminController@getUsers');
$router->post('/admin/updateuserrole', 'AdminController@updateUserRole');
$router->get('/admin/getpendingcommentaire', 'AdminController@getPendingCommentaire');
$router->post('/admin/acceptercommentaire', 'AdminController@acceptUserCommentaire');
$router->post('/admin/refusercommentaire', 'AdminController@refuseUserCommentaire');

$router->get('/profil/{userName}', 'ProfilController@getProfil');
$router->post('/profil/supprimerprofil', 'ProfilController@MakeAnonymeUser');
