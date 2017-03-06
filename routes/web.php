<?php

//Route d'accueil
Route::get('/', 'AccueilController@index');

//Route du header
Route::get('/deconnexion', 'DeconnexionController@index');


Auth::routes();

