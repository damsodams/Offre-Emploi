<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Notifications\OffreNotification;
use Illuminate\Support\Facades\Auth;
use App\Offre;
use App\Entreprise;
use App\User;
use Validator;


class OffreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lesOffres = Offre::all();
        return view("back.offre.index")->with("lesOffres",$lesOffres);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lesentreprises = Entreprise::all();
        $user = auth::user(); 
        return view("back.offre.create", compact('user', 'lesentreprises'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $validator = Validator::make($request->all(), [
        'titre' => 'required',
        'intitule' => 'required',
        'description' => 'required',
        'secteur' => 'required',
        'niveau' => 'required',
        'contrat' => 'required',
        'entreprise' => 'required',
      ]);
      if ($validator->fails()){
        return redirect()->route("offre.create")->withErrors($validator)->withInput();
      }

        $offre = new Offre;
        $offre->titre =$request->input('titre');
        $offre->description =$request->input('description');
        $offre->intitule_poste =$request->input('intitule');
        $offre->niveau =$request->input('niveau');

        //Pour le PDF
        $rand = str_random(15);
        $pdf_upload = $request->file('file');
        if($pdf_upload != NULL){
          // Définition du chemin de stockage
          // Nommage du fichier
          $pdf_nommage = date('Y-m-d') . ' - ' . $rand .' - '. $pdf_upload->getClientOriginalName();
          // On indique le chemin du fichier pour la base de donnée
          $pdf_get = 'pdf\\' . $pdf_nommage;
          // Si il y a bien un fichier, on le déplace dans le répertoire et on stock le chemin dans la base de donnée
          if ($pdf_upload) {
              if ($pdf_upload->move('pdf', $pdf_nommage)) {
                $offre->pdf = $pdf_get;
              }
          } else {
              return redirect()->route('offres.index')->withStatus(__('Problème lors de l\'upload du PDF, veuillez essayer à nouveau.'));
          }
        }

        $offre->salaire =$request->input('salaire');
        $offre->secteur =$request->input('secteur');
        $offre->type_contrat =$request->input('contrat');
        $offre->entreprise_id =$request->input('entreprise');
        $offre->save();

        /**Envoie d'un mail à tout les utilisateurs lors de la création*/
        $lesUsers = User::all()->where('statut', 'Utilisateur');

        foreach ($lesUsers as $user) {
          $user->notify(new OffreNotification($offre->id));
        }

        return redirect()->route("offre.index")->with('success','Création réussite !');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $offre = Offre::find($id);
      $lesentreprises = Entreprise::all();

      return view('back.offre.edit')->with('offre', $offre)
                                    ->with("lesentreprises",$lesentreprises);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $validator = Validator::make($request->all(), [
        'titre' => 'required',
        'intitule' => 'required',
        'description' => 'required',
        'secteur' => 'required',
        'niveau' => 'required',
        'contrat' => 'required',
        'entreprise' => 'required',
      ]);
      if ($validator->fails()){
        return redirect()->route("offre.edit",$id)->withErrors($validator)->withInput();
      }
      $offre = Offre::find($id);
      $offre->titre = $request->input('titre');
      $offre->intitule_poste =$request->input('intitule');
      $offre->description =$request->input('description');
      $offre->niveau =$request->input('niveau');

      //Pour le PDF
      if ($request->file('file')!= NULL){
        unlink(public_path($offre->pdf));
        $rand = str_random(1500);
        $pdf_upload = $request->file('file');
        // Définition du chemin de stockage
        // Nommage du fichier
        $pdf_nommage = date('Y-m-d') . ' - '. $rand .' - '. $pdf_upload->getClientOriginalName();
        // On indique le chemin du fichier pour la base de donnée
        $pdf_get = 'pdf\\' . $pdf_nommage;
        // Si il y a bien un fichier, on le déplace dans le répertoire et on stock le chemin dans la base de donnée
        if ($pdf_upload) {
            if ($pdf_upload->move('pdf', $pdf_nommage)) {
              $offre->pdf =$pdf_get;
            }
        } else {
            return redirect()->route('offres.index')->withStatus(__('Problème lors de l\'upload du PDF, veuillez essayer à nouveau.'));
        }
      }

      $offre->salaire =$request->input('salaire');
      $offre->secteur =$request->input('secteur');
      $offre->type_contrat =$request->input('contrat');
      $offre->entreprise_id =$request->input('entreprise');
      $offre->save();

      return redirect()->route("offre.index")->with('success','Modification réussite !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $offre = Offre::find($id);
      if ($offre->pdf) {
        unlink(public_path($offre->pdf));
      }

      Offre::find($id)->delete();

      return redirect()->route("offre.index")->with('warning','Suppression réussite !');
    }
}
