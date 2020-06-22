@extends('layouts.templateBack')
@section('titre')
   Ajouter une offre 
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

<form style='margin-left:10px;' method="POST" action="{{route('offres_entreprise.store')}}" enctype="multipart/form-data">
@csrf
  <div class="form-group">
    <label for="Titre">Titre *</label>
    <input type="text" class="form-control" id="titre" name="titre" placeholder="Titre de l'offre">
  </div>

  <div class="form-group">
    <label for="Intitule_poste">Intitulé du poste *</label>
    <input type="text" class="form-control" id="intitule" name="intitule"  placeholder="Intitulé du poste"></textarea>
  </div>

  <div class="form-group">
    <label for="Secteur">Secteur *</label>
    <input type="text" class="form-control" id="secteur" name="secteur" placeholder="Secteur"></textarea>
  </div>

  <div class="form-group">
    <label for="Desciption">Description *</label>
    <textarea class="form-control" id="description" name="description" rows="5" placeholder="Description de l'offre"></textarea>
  </div>

  <div class="form-group">
     <label for="Niveau">Niveau *</label>
     <select class="form-control" id="niveau" name="niveau">
       <option>BAC</option>
       <option>BTS</option>
       <option>Licence</option>
       <option>Autre</option>
     </select>
  </div>

  <div class="form-group">
    <label for="Upload">Ajouter un PDF (file)</label>
     <div class="input-group mb-3">
       <div class="custom-file">
         <input type="file" id="file" name="file">
       </div>
     </div>
  </div>

  <div class="form-group">
    <label for="Contrat">Contrat *</label>
    <select class="form-control" id="contrat" name="contrat">
       <option>CDD</option>
       <option>CDI</option>
       <option>Contrat de professionnalisation</option>
       <option>Contrat d apprentissage</option>
     </select>
  </div>

  <div class="form-group">
    <label for="Salaire">Salaire</label>
    <input type="text" class="form-control" id="salaire" name="salaire"  placeholder="Salaire"></textarea>
  </div>


 <div class="form-group" hidden>
    <label for="ENTREPRISE">Entreprise *</label>
    <select class="form-control" id="entreprise" name="entreprise">
        <option value="{{ $entrepriseUser }}"></option>
    </select>
  </div>

    <button type="submit" class="btn btn-primary center-block">
        Créer
    </button>
  </form>

@endsection
