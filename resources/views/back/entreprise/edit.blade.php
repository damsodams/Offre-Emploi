@extends('layouts.templateBack')
@section('titre')
   Modifier l'entreprise '{{$entreprise->nom}}'
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

<form style='margin-left:10px;' method="POST" action="{{route('entreprise.update', $entreprise->id)}}">
@csrf
@method('PUT')
  <div class="form-group">
    <label for="Nom">Nom *</label>
    <input type="text" class="form-control" id="nom" name="nom" value="{{$entreprise->nom}}">
  </div>
  <div class="form-group">
    <label for="ville">Ville *</label>
    <input type="text" class="form-control" id="ville" name="ville" value="{{$entreprise->ville}}">
  </div>
  <div class="form-group">
    <label for="codePostal">Code Postal *</label>
    <input type="text" class="form-control" id="codePostal" name="codePostal" value="{{$entreprise->codePostal}}">
  </div>
  <div class="form-group">
    <label for="adresse">Adresse *</label>
    <input type="text" class="form-control" id="adresse" name="adresse" value="{{$entreprise->adresse}}">
  </div>
  <div class="form-group">
    <label for="contact">Contact *</label>
    <input type="text" class="form-control" id="contact" name="contact" value="{{$entreprise->contact}}">
  </div>
  <div class="form-group">
    <label for="telephone">Téléphone *</label>
    <input type="text" class="form-control" id="telephone" name="telephone" value="{{$entreprise->telephone}}">
  </div>
  <div class="form-group">
    <label for="mail">Mail *</label>
    <input type="text" class="form-control" id="mail" name="mail" value="{{$entreprise->mail}}">
  </div>
  <div class="form-group">
    <label for="adresse">Carte google MAP</label>
    <input type="text" class="form-control" id="map" name="map" value="{{$entreprise->map}}">
  </div>

    <button style='margin-bottom:10px;' type="submit" class="btn btn-primary">
        Modifier
    </button>
  </form>

@endsection
