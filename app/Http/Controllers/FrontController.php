<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Offre;
use App\User;
use App\Entreprise;

class FrontController extends Controller
{
  //
  public function index(){
    $user = auth::user();
    $lesOffres = Offre::orderBy('created_at' , 'DESC', 'updated_at' ,'DESC')->get();
    $lesEntreprises = Entreprise::all();
    return view ('front.accueil', compact('user', 'lesOffres', 'lesEntreprises'));
  }

  public function show($id){
    $offre = Offre::find($id);
    return view ('front.offre')->with('offre', $offre);
  }

  public function pdf($pathToFile){
    return Response::download($pathToFile);
  }

  public function filter(Request $request){
    $user = auth::user();
    $lesEntreprises = Entreprise::all();
    if($request->input('search')){
      $lesOffres = Offre::where('titre', 'like', '%'.$request->input('search').'%')->orderBy('created_at' , 'DESC', 'updated_at' ,'DESC')->get();
      $count = $lesOffres->count();
      return view ('front.accueil', compact('user', 'lesOffres', 'count','lesEntreprises'));
    }else{
      $lesOffres = Offre::orderBy('created_at' , 'DESC', 'updated_at' ,'DESC')->get();
      return view ('front.accueil', compact('user', 'lesOffres','lesEntreprises'));
    }
    /*
    SELECT *
    FROM users
    WHERE
    name LIKE '%da%'
    ORDER BY name*/
  }
  public function filters(Request $request){

    $user = auth::user();
    $lesEntreprises = Entreprise::all();

    $offres = Offre::whereHas('entreprise', function($q) {
        $q->where('ville', 'Dijon');
    })->get();
    dd($offres);

    $lesOffres = Offre::all();
    if($request->input('entreprise')!= "..."){
      $lesOffres = $lesOffres->where('entreprise_id', $request->input('entreprise'));
    }
    if($request->input('contrat')!= "..."){
      $lesOffres = $lesOffres->where('type_contrat', $request->input('contrat'));
    }
    if($request->input('niveau') != "..."){
      $lesOffres = $lesOffres->where('niveau', $request->input('niveau'));
    }
    if($request->input('ville')!= "..."){
      $lesOffres = $lesOffres->whereHas('entreprise', function($q) {
          $q->where('ville', $request->input('ville'));
      })->get();
    }
    dd($lesOffres);

    return view ('front.accueil', compact('user', 'lesOffres','lesEntreprises'));

  }
}
