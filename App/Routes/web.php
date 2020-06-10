<?php

/**
 * Para rota autenticadas no desenvolvimento web podemos usar a rota AUTH
 *
 * EX: $route->auth(['aqui vai um ou mais metodos aceitos na rota'], '/path', 'Controller@metodo');
 *
 * esta rota recebe um array passando os metodos aceitos exemplo: ['get', 'post', 'etc...']
 * o segundo paramentro é um path ex: '/home' e o último parámetro é o controller@metoodo ex: 'HomeController@index'
 */

$route->group(null);
$route->get('/', 'HomeController@index');
$route->get('/recomendation', 'HomeController@recomendation');
$route->get('/genre/{genre}', 'HomeController@recomendationByGenre');
$route->get('/search-film/{filmName}', 'HomeController@searchFilm');
$route->get('/search', 'HomeController@search');
$route->get('/view-detail/{filmId}', 'HomeController@viewDetail');
$route->get('/film/{filmId}', 'HomeController@film');

$route->get('/back', 'UserController@goBack');
$route->get('/login', 'UserController@index');
$route->get('/register', 'UserController@register');
$route->post('/new-user', 'UserController@saveUser');
$route->post('/make-login', 'UserController@login');
$route->post('/password-rescue', 'UserController@newPass');
$route->get('/passwordRescue', 'UserController@passwordRescue');
$route->get('/create-password', 'UserController@saveNewPassword');
$route->post('/password-reset', 'UserController@passwordReset');

$route->auth(['get'], '/dashboard', 'DashboardController@index');
$route->auth(['get'], '/dashboard/recomendation', 'DashboardController@recomendation');
$route->auth(['get'], '/dashboard/genre/{genre}', 'DashboardController@recomendationByGenre');
$route->auth(['get'], '/exit', 'DashboardController@exit');
$route->auth(['delete'], '/delete-user', 'DashboardController@deleteUser');
$route->auth(['get'], '/alter-user', 'DashboardController@alterUser');
$route->auth(['put'], '/update-user', 'DashboardController@updateUser');
$route->auth(['get'], '/watched', 'DashboardController@watcheds');
$route->auth(['get'], '/watch', 'DashboardController@watch');
$route->auth(['get'], '/dashboard/watch-data', 'DashboardController@watchData');
$route->auth(['get'], '/watched', 'DashboardController@watched');
$route->auth(['get'], '/dashboard/watched-data', 'DashboardController@watchedData');
$route->auth(['get'], '/save/{filmId}', 'DashboardController@saveToWatch');
$route->auth(['get'], '/view/{filmId}', 'DashboardController@addViewed');
$route->auth(['get'], '/remove/{filmId}', 'DashboardController@removeViewed');
$route->auth(['get'], '/loged-film/{filmId}', 'DashboardController@logedFilm');
