<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;
use App\Entreprise;

class UtilisateurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $lesUtilisateurs = User::All();
        return view("back.utilisateur.index")->with("lesUtilisateurs", $lesUtilisateurs);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $lesEntreprises = Entreprise::All();
        return view('back.utilisateur.create')->with('lesentreprises', $lesEntreprises);
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
          'name' => 'required',
          'email' => 'required|email',
          'mdp' => 'required',
          'statut' => 'required',
        ]);
        if ($validator->fails()){
          return redirect()->route("utilisateur.create")->withErrors($validator)->withInput();
        }
        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('mdp'));
        $user->statut = $request->input('statut');
        if($request->input('statut')=="Entreprise"){
          $user->entreprise_id = $request->input('entreprise');
        }
        $user->save();

        return redirect()->route("utilisateur.index")->with('success','Création réussite !');
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
        //
        $lesEntreprises = Entreprise::All();
        $user = User::find($id);
        return view('back.utilisateur.edit')->with('user', $user)
                                            ->with('lesentreprises',$lesEntreprises);
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
          'nom' => 'required',
          'email' => 'required|email',
          'mdp' => 'required',
          'statut' => 'required',
        ]);
        if ($validator->fails()){
          return redirect()->route("utilisateur.edit",$id)->withErrors($validator)->withInput();
        }
        $user = User::find($id);
        $user->name = $request->input('nom');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('mdp'));
        $user->statut = $request->input('statut');
        if($request->input('statut')=="Entreprise"){
          $user->entreprise_id = $request->input('entreprise');
        }
        $user->save();

        return redirect()->route("utilisateur.index")->with('success','Modification réussite !');
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
        User::find($id)->delete();

        return redirect()->route("utilisateur.index")->with('warning','Suppression réussite !');
    }
}
