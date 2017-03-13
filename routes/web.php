<?php

//Route d'accueil
Route::get('/', 'AccueilController@index');
Route::post('/afficher_fiche_de_frais', 'AccueilController@afficherFdfPost');

//Route du header
Route::get('/afficher_fiche_de_frais', 'AccueilController@afficherFdf');

Route::get('/afficher_renseigner_frais', 'GererFraisController@afficherRf');

Route::get('/deconnexion', 'DeconnexionController@index');




Auth::routes();

