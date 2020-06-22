<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Routes de l'Authentification
Auth::routes();

//Les routes pour les Utilisateurs du site -> FRONT
Route::group(['middleware'=>'auth'],function () {
  //La route qui redirige sur mon front
  Route::get('/', 'FrontController@index')->name('front');
  //La route qui redirige vers le panel user
  Route::resource('config', 'ConfigUserController');
  //La route qui redirife vers l'offre selected
  Route::get('offre/{id}', 'FrontController@show')->name('frontoffre');

  Route::post('look','FrontController@filter')->name('frontoffrefilter');
  // La route qui permet de realiser des filtres
  Route::post('filter','FrontController@filters')->name('frontoffrefilters');
  });
  //La route qui redirife vers l'offre selected
  Route::get('pdf', 'FrontController@pdf')->name('frontoffrepdf');

//Les routes pour les Admins du site -> BACK
Route::group(['middleware'=>'auth','middleware'=>'admin'],function () {

  //Route Affichage DASHBOARD
  Route::resource('back/dashboard', 'DashboardController');

  //Route gestion OFFRE
  Route::resource('back/offre', 'OffreController');

  //Route gestion ENTREPRISE
  Route::resource('back/entreprise', 'EntrepriseController');

  //Route gestion UTILISATEUR
  Route::resource('back/utilisateur', 'UtilisateurController');

});

//Les routes pour les Entreprises du site -> BACK
Route::group(['middleware'=>'auth','middleware'=>'entreprise'],function () {

  //Route gestion OFFRE
  Route::resource('back/offres_entreprise', 'EntrepriseOffreController');
});
