<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entreprise;
use Validator;

class EntrepriseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lesEntreprises = Entreprise::All();
        return view("back.entreprise.index")->with("lesEntreprises", $lesEntreprises);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("back.entreprise.create");
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
            'nom' => 'required',
            'ville' => 'required',
            'codePostal' => 'required',
            'adresse' => 'required',
            'contact' => 'required',
            'telephone' => 'required',
            'mail' => 'required',
          ]);
        if ($validator->fails()){
           return redirect()->route("entreprise.create")->withErrors($validator)->withInput();
        }

        //les inputs font référence à tes name de ton formulaire, GL pour la suite Arthur :)
        $entreprise = new Entreprise;
        $entreprise->nom = $request->input('nom');
        $entreprise->ville = $request->input('ville');
        $entreprise->codePostal = $request->input('codePostal');
        $entreprise->adresse = $request->input('adresse');
        $entreprise->contact = $request->input('contact');
        $entreprise->telephone = $request->input('telephone');
        $entreprise->mail = $request->input('mail');
        $entreprise->map = $request->input('map');
        $entreprise->save();

        return redirect()->route("entreprise.index")->with('success','Création réussite !');
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
        $entreprise = Entreprise::find($id);
        return view('back.entreprise.edit')->with('entreprise', $entreprise);
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
            'nom' => 'required',
            'ville' => 'required',
            'codePostal' => 'required',
            'adresse' => 'required',
            'contact' => 'required',
            'telephone' => 'required',
            'mail' => 'required',
          ]);
        if ($validator->fails()){
           return redirect()->route("entreprise.edit",$id)->withErrors($validator)->withInput();
        }

        $entreprise = Entreprise::find($id);
        $entreprise->nom = $request->input('nom');
        $entreprise->ville = $request->input('ville');
        $entreprise->codePostal = $request->input('codePostal');
        $entreprise->adresse = $request->input('adresse');
        $entreprise->contact = $request->input('contact');
        $entreprise->telephone = $request->input('telephone');
        $entreprise->mail = $request->input('mail');
        $entreprise->map = $request->input('map');
        $entreprise->save();

        return redirect()->route("entreprise.index")->with('success','Modification réussite !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Entreprise::find($id)->delete();

        return redirect()->route("entreprise.index")->with('warning','Suppression réussite !');
    }
}
