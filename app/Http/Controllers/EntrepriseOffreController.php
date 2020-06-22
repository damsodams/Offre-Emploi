<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

use App\Mail\NouvelleOffre;
use App\Notifications\OffreNotification;
use App\User;
use App\Offre;
use Validator;

class EntrepriseOffreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $entrepriseUser = auth::user()->entreprise_id;
        $lesOffres = Offre::All()->where('entreprise_id',$entrepriseUser);
        $entrepriseName = auth::user()->entreprise->nom;
        return view("back.entreprise_offre.index")->with("lesOffres",$lesOffres)
                                                  ->with("entrepriseName",$entrepriseName);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $entrepriseUser = auth::user()->entreprise_id;
        return view("back.entreprise_offre.create")->with("entrepriseUser", $entrepriseUser);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
          return redirect()->route("offres_entreprise.create")->withErrors($validator)->withInput();
        }

          $offre = new Offre;
          $offre->titre =$request->input('titre');
          $offre->description =$request->input('description');
          $offre->intitule_poste =$request->input('intitule');
          $offre->niveau =$request->input('niveau');

          //Pour le PDF
          $pdf_upload = $request->file('file');
          if($pdf_upload != NULL){
            // Définition du chemin de stockage
            // Nommage du fichier
            $pdf_nommage = date('Y-m-d') . ' - ' . $pdf_upload->getClientOriginalName();
            // On indique le chemin du fichier pour la base de donnée
            $pdf_get = 'pdf\\' . $pdf_nommage;
            // Si il y a bien un fichier, on le déplace dans le répertoire et on stock le chemin dans la base de donnée
            if ($pdf_upload) {
                if ($pdf_upload->move('pdf', $pdf_nommage)) {
                  $offre->pdf = $pdf_get;
                }
            } else {
                return redirect()->route('offres_entreprise.index')->withStatus(__('Problème lors de l\'upload du PDF, veuillez essayer à nouveau.'));
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

          return redirect()->route("offres_entreprise.index")->with('success','Création réussite !');

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
        $offre = Offre::find($id);
        return view('back.entreprise_offre.show')->with('offre', $offre);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $offre = Offre::find($id);
        return view('back.entreprise_offre.edit')->with('offre', $offre);
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
        //
        $validator = Validator::make($request->all(), [
          'titre' => 'required',
          'intitule' => 'required',
          'description' => 'required',
          'secteur' => 'required',
          'niveau' => 'required',
          'contrat' => 'required',
        ]);
        if ($validator->fails()){
          return redirect()->route("offres_entreprise.edit",$id)->withErrors($validator)->withInput();
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
              return redirect()->route('offres_entreprise.index')->withStatus(__('Problème lors de l\'upload du PDF, veuillez essayer à nouveau.'));
          }
        }

        $offre->salaire =$request->input('salaire');
        $offre->secteur =$request->input('secteur');
        $offre->type_contrat =$request->input('contrat');
        $offre->save();

        return redirect()->route("offres_entreprise.index")->with('success','Modification réussite !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $offre = Offre::find($id);
        if ($offre->pdf) {
          unlink(public_path($offre->pdf));
        }

        Offre::find($id)->delete();

        return redirect()->route("offres_entreprise.index")->with('warning','Suppression réussite !');
    }
}
