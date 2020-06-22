@extends('layouts.templateBack')
@section('titre')
   Modifier l'offre '{{$offre->titre}}'
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

<form style='margin-left:10px;' method="POST" action="{{route('offres_entreprise.update', $offre->id)}}" enctype="multipart/form-data">
@csrf
@method('PUT')
  <div class="form-group">
    <label for="Titre">Titre *</label>
    <input type="text" class="form-control" id="titre" name="titre" value="{{$offre->titre}}">
  </div>

  <div class="form-group">
    <label for="Intitule_poste">Intitulé du poste *</label>
    <input type="text" class="form-control" id="intitule" name="intitule"  value="{{$offre->intitule_poste}}"></textarea>
  </div>

  <div class="form-group">
    <label for="Secteur">Secteur *</label>
    <input type="text" class="form-control" id="secteur" name="secteur" value="{{$offre->secteur}}"></textarea>
  </div>

  <div class="form-group">
    <label for="Description">Description *</label>
    <input type="text" class="form-control" id="description" name="description" value="{{$offre->description}}">
  </div>

  <div class="form-group">
     <label for="Niveau">Niveau *</label>
     <select class="form-control" id="niveau" name="niveau">
       <option>BAC</option>
       <option>BTS</option>
       <option>Licence</option>
       <option>Autre</option>
       <option selected hidden>{{$offre->niveau}}</option>
     </select>
   </div>

   <div class="form-group">
    <label for="Upload">Ajouter un PDF</label>
     <div>
       <div>
         <label style="font-weight: 400;" for="inputGroupFile02">Remplacer :</label>
         <label style="font-weight: 700;" for="inputGroupFile02">
           <?php
           $value = $offre->pdf;
           $rest = substr($value, 34);
           echo $rest;

           if($rest == NULL){echo 'No file selected';};
          ?>
        </label>
          <label style="font-weight: 400;" for="inputGroupFile02"> par </label>
         <input type="file" id="file" name="file" onchange="handleFiles(this.files)">

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
       <option selected hidden>{{$offre->type_contrat}}</option>
     </select>
  </div>

  <div class="form-group">
    <label for="Salaire">Salaire</label>
    <input type="text" class="form-control" id="salaire" name="salaire"  value="{{$offre->salaire}}"></textarea>
  </div>

    <button style='margin-bottom:10px;' type="submit" class="btn btn-primary">
        Modifier
    </button>
  </form>

@endsection
