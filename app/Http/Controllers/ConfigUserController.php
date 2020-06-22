<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\User;
use Validator;
use Hash;

class ConfigUserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $user = Auth::user();
      return view("front.config")->with('user', $user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
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
        $user = Auth::user();
        $allUser = user::all();
        $user = user::find($id);
        $text = "Aucun changement effectué";

        if(Hash::check($request->input('password'), $user->password)){ //Verification du mdp de passe du compte
            if($request->has('emailBox')){ // si la mail box est coché
                $validator = Validator::make($request->all(), [ // SI champ vide alors erreur 
                    'adresseMail' => 'required|email',
                ]);
                if ($validator->fails()){
                    return redirect()->route("config.index")->withErrors($validator)->withInput();
                }
                foreach($allUser as $unUser){ // On parcours les utilisateurs 
                    if($unUser->email == $request->input('adresseMail')){ // Si l'adresse mail entré est déjà existante alors on retourne l'érreur
                        return redirect()->route("config.index")->withErrors("Adresse mail déja existante")->withInput();
                    }
                }
                $user->email = $request->input('adresseMail');
                $user->save();
                $text = "Adresse émail changée !";
            }
            else if($request->has('mdpBox')){ // sinon si la mdp box est coché
                if($request->input('password') == $request->input('newMdp')){ // Si le Nouveau mdp est identique à l'ancien on indique l'erreur
                    return redirect()->route("config.index")->withErrors("Le nouveau mot de passe ne doit pas être identique à l'ancien")->withInput();
                }
                else if($request->input('newMdp') == $request->input('againNewMdp')){ // Sinon si les deux Nouveau mdp sont identiques on fait le changement de mdp
                    $user->password = bcrypt($request->input('newMdp'));
                    $user->save();
                    $text = "Mot de passe changé !";
                }else{  // Sinon on indique ques les deux nouveau mdp ne sont pas identique
                    return redirect()->route("config.index")->withErrors("Les deux nouveaux mots de passe ne sont pas identiques")->withInput();
                }
            }
            
            return redirect()->route("front")->with('success', $text); // Si tous se déroule bien  on retourne sur le front en affichant la modification éffectué
        }
        else{ // Si le mot de passe de l'utilisateur est incorrecte on retourne l'erreur
            return redirect()->route("config.index")->withErrors("Mot de passe incorrect")->withInput();
        }
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
    }
}
