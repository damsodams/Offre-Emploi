<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Offre;
use App\Entreprise;
use App\User;

class DashboardController extends Controller
{
  public function index(){
    $lesEntreprises = Entreprise::All();
    $lesOffres = Offre::All();
    $lesUsers = User::All();
    return view("back.dashboard.index")->with("lesEntreprises", $lesEntreprises)
                                        ->with("lesOffres" , $lesOffres)
                                        ->with('lesUsers', $lesUsers);
  }
}
