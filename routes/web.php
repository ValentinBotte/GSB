<?php

//Route d'accueil
Route::get('/', 'AccueilController@index');

// VISITEUR

Route::get('/afficher_fiche_de_frais', 'AccueilController@afficherFdf');

Route::post('/afficher_fiche_de_frais', 'AccueilController@afficherFdfPost');

Route::get('/afficher_renseigner_frais/{id}', 'GererFraisController@supprimerFiche');

Route::get('/afficher_renseigner_frais', 'GererFraisController@afficherRf');

Route::post('/afficher_renseigner_frais', 'GererFraisController@ajoutFraisForfait');

// COMPTABLE

Route::get('/afficher_valide_frais', 'ComptableFraisController@valideFrais');

Route::post('/afficher_valide_frais', 'ComptableFraisController@afficherFiche');

Route::get('/afficher_suivi_frais', 'GererFraisController@afficherRf');

//

Route::get('/deconnexion', 'DeconnexionController@index');




Auth::routes();

