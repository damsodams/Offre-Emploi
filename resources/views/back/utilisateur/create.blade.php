@extends('layouts.templateBack')
@section('titre')
   Ajouter un utilisateur
@stop

@section('contenu')

<text style='margin-left:10px;color:red;'>* Champs obligatoires</text>
<br> </br>

  @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

<form style='margin-left:10px;' method="POST" action="{{route('utilisateur.store')}}">
@csrf
  <div class="form-group">
    <label for="nom">Nom *</label>
    <input type="text" class="form-control" id="name" name="name" placeholder="Entrer le nom">
  </div>
  <div class="form-group">
    <label for="email">Email *</label>
    <input type="text" class="form-control" id="email" name="email" placeholder="Entrer l'email">
  </div>
  <div class="form-group">
    <label for="mdp">Mot de Passe *</label>
    <input type="password" class="form-control" id="mdp" name="mdp" placeholder="Entrer le mot de passe" >
  </div>
  <div class="form-group">
    <label for="statut">Statut *</label>
    <select class="form-control" id="statut" name="statut" onchange="change_valeur();">
      <option>Utilisateur</option>
      <option>Administrateur</option>
      <option>Entreprise</option>
    </select>
  </div>

  <div class="form-group" id="entreprise">
    <label for="ENTREPRISE">Entreprise *</label>
    <select class="form-control" id="entreprise" name="entreprise">
        @foreach ($lesentreprises as $entreprise)
        <option value="{{ $entreprise->id }}">{{ $entreprise->nom }}</option>
        @endforeach
    </select>
  </div>
    <button style='margin-bottom:10px;' type="submit" class="btn btn-primary">
        Créer
    </button>
  </form>
  <script>
  document.getElementById('entreprise').style.visibility='hidden';
  function change_valeur() {
  select = document.getElementById("statut");
    choice = select.selectedIndex;
    valeur = select.options[choice].value;
    if (valeur =="Entreprise") {
      document.getElementById('entreprise').style.visibility='visible';
    }else{
      document.getElementById('entreprise').style.visibility='hidden';
    }
  }
  </script>
@endsection
