@extends('layouts.templateBack')
@section('titre')
   Ajouter une entreprise
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

<form style='margin-left:10px;' method="POST" action="{{route('entreprise.store')}}">
@csrf
  <div class="form-group">
    <label for="Nom">Nom *</label>
    <input type="text" class="form-control" id="nom" name="nom" placeholder="Entrer le nom">
  </div>
  <div class="form-group">
    <label for="ville">Ville *</label>
    <input type="text" class="form-control" id="ville" name="ville" placeholder="Entrer la ville">
  </div>
  <div class="form-group">
    <label for="codePostal">Code Postal *</label>
    <input type="text" class="form-control" id="codePostal" name="codePostal" placeholder="Entrer le code postal">
  </div>
  <div class="form-group">
    <label for="adresse">Adresse *</label>
    <input type="text" class="form-control" id="adresse" name="adresse" placeholder="Entrer l'adresse">
  </div>
  <div class="form-group">
    <label for="contact">Contact *</label>
    <input type="text" class="form-control" id="contact" name="contact" placeholder="Entrer le nom du contact">
  </div>
  <div class="form-group">
    <label for="telephone">Téléphone *</label>
    <input type="text" class="form-control" id="telephone" name="telephone" placeholder="Entrer le numéro de téléphone">
  </div>
  <div class="form-group">
    <label for="mail">Mail *</label>
    <input type="text" class="form-control" id="mail" name="mail" placeholder="Entrer l'adresse mail">
  </div>
  <div class="form-group">
    <label for="adresse">Carte google MAP</label>
    <input type="text" class="form-control" id="map" name="map" placeholder=" exemple : https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2714.020020207576!2d5.44144331581544!3d47.13787382823184!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47f2b2ee6179ebd7%3A0xdad657b1d7ce569a!2s18%20Rue%20de%20la%20Chapelle%2C%2039290%20Biarne!5e0!3m2!1sfr!2sfr!4v1588507517102!5m2!1sfr!2sfr-hidden= ">
  </div>
    <button style='margin-bottom:10px;' type="submit" class="btn btn-primary">
        Créer
    </button>
  </form>

@endsection
