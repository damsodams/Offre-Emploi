@extends('layouts.templateBack')
@section('titre')
   Modifier l'utilisateur : '{{$user->name}}'
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

<form style='margin-left:10px;' method="POST" action="{{route('utilisateur.update', $user->id)}}">
@csrf
@method('PUT')
<div class="form-group">
  <label for="nom">Nom *</label>
  <input type="text" class="form-control" id="nom" name="nom" value="{{$user->name}}">
</div>
<div class="form-group">
  <label for="email">Email *</label>
  <input type="text" class="form-control" id="email" name="email" value="{{$user->email}}">
</div>
<div class="form-group">
  <label for="mdp">Mot de Passe *</label>
  <input type="password" class="form-control" id="mdp" name="mdp" placeholder="Remettre un mot de passe">
</div>
<div class="form-group">
  <label for="statut">Statut *</label>
  <select class="form-control" id="statut" name="statut" onchange="change_valeur();">
    <option selected>{{$user->statut}}</option>
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
        Modifier
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
