@extends('layouts.templateFront')
@section('contenu')
<!-- Compteur de Vue ! -->
<?php
$hits = 0;
if (empty ($hits)){
  $fp = fopen("compteur.txt","a+");
  $num=fgets($fp,4096);
  fclose($fp);
  $hits=$num - -  1;
  $fp = fopen("compteur.txt","w");
  fputs($fp,$hits);
  fclose($fp);
}
 ?>

  <div class="card_post">
    <div class="card-header">
      <h4 style="font-size : 2.1rem;"class="card-title">{{$offre->titre}}</h4>
    </div>
    <div class="card-body">
      <div class="form-group">
        <label>Intitulé du poste</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-user-tie"></i></span>
          </div>
          <input readonly type="text" class="form-control" value="{{$offre->intitule_poste}}">
        </div>
      </div>
      <div class="form-group">
        <label>Entreprise</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-building"></i></span>
          </div>
          <input readonly type="text" class="form-control" value="{{$offre->entreprise->nom}}">
        </div>
      </div>
      <div class="form-group">
        <label>Déscription du poste</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-greater-than"></i></span>
          </div>
          <textarea style="width: 95%; background: #e9ecef; width: 95%;border: 1px solid #ced4da;border-radius: 3px;" readonly name="Text1" cols="40" rows="5">{{$offre->description}}</textarea>
        </div>
      </div>
      <div class="form-group">
        <label>Niveau Requis</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-graduation-cap"></i></span>
          </div>
          <input readonly type="text" class="form-control" value="{{$offre->niveau}}">
        </div>
      </div>
      <div class="form-group">
        <label>Secteur</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-laptop"></i></span>
          </div>
          <input readonly type="text" class="form-control" value="{{$offre->secteur}}">
        </div>
      </div>
      <div class="form-group">
        <label>Type de contrat</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-file-contract"></i></span>
          </div>
          <input readonly type="text" class="form-control" value="{{$offre->type_contrat}}">
        </div>
      </div>
      <div class="form-group">
        <label>Salaire</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-euro-sign"></i></span>
          </div>
          <input readonly type="text" class="form-control" value="{{$offre->salaire}}">
        </div>
      </div>
      @if ($offre->pdf != NULL)
        <div class="form-group">
          <label>Fiche complete du poste</label>
          <div class="input-group">
            <a href="{{asset($offre->pdf)}}" target="_blank">
              <img class="card_img" src="{{url('images/pdf.png')}}">
            </a>
          </div>
        </div>
      @endif
      <div class="form-group">
        <label>Localisation</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-location-arrow"></i></span>
          </div>
          <input readonly type="text" class="form-control" value="{{$offre->entreprise->adresse}} {{$offre->entreprise->ville}} {{$offre->entreprise->codePostal}}">
        </div>
        <br>
        @if ($offre->entreprise->map)
          <iframe src="{{$offre->entreprise->map}}" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        @endif
      </div>
      <br>
      <div class="input-group">
        <button style="width: 100%;background: #57b846;  height: 40px;border-radius: 5px;"><a class="link_post" href="mailto:{{$offre->entreprise->mail}}">Postuler</a></button>
      </div>
    </div>
  </div>
@stop
