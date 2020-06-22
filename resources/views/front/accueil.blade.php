@extends('layouts.templateFront')
@section('contenu')

  @include('back.alert-message')
  @if (isset($count))
    @if ($count == 0)
      <h3 style="color: #de1b1b ;"> Aucune offre trouver ! </h1>
      @endif
      @if ($count != 0)
        <h3 style="color: #57b846 ;">nombre d'offre trouver {{$count}} </h1>
        @endif

      @endif
      <!-- script -->
      <script>
      function filtrage(){
        let d1 = document.getElementById("div");
        if(getComputedStyle(d1).display != "none"){
          d1.style.display = "none";
          document.getElementById("btn").innerHTML = "Voire";
        } else {
          d1.style.display = "block";
          document.getElementById("btn").innerHTML = "Masquer";
        }
      }
      </script>
      <label>filtres</label>
      <button style="color : c3c3c3"onclick="filtrage()"id="btn">Voir</button>


      <!--Les filtres  -->
      <div id="div" style="display:none;" class="div">
        <div class="container">
          <section class="row">
            <section class="content">
              <div class="container-fluid">
                <div class="card card-primary card-outline">
                  <div class="card-body">
                    <div class="form-group">
                      <form class="filterforms" method="post" action="{{route('frontoffrefilters')}}">
                        @csrf
                        <label>Entreprise
                          <select id="entreprise" name="entreprise" class="form-control">
                            <option selected >...</option>
                            @foreach ($lesEntreprises as $entreprise)
                              <option value="{{$entreprise->id}}">{{$entreprise->nom}}</option>
                            @endforeach
                          </select>
                        </label>
                        <label>Ville
                          <select id="ville" name="ville" class="form-control">
                            <option selected>...</option>
                            @foreach ($lesEntreprises as $entreprise)
                              <option value="{{$entreprise->ville}}">{{$entreprise->ville}}</option>
                            @endforeach
                          </select>
                        </label>
                        <label>Contrat
                          <select id="contrat" name="contrat" class="form-control">
                            <option selected>...</option>
                            <option value="CDD">CDD</option>
                            <option value="CDI">CDI</option>
                            <option value="Contrat de professionnalisation">Contrat Pro</option>
                            <option value="Contrat apprentissage">Apprentissage</option>
                          </select>
                        </label>
                        <label>Niveau
                          <select id="niveau" name="niveau" class="form-control">
                            <option selected>...</option>
                            <option value="bts">BTS</option>
                            <option value="licence">LICENCE</option>
                          </select>
                        </label>
                        <br>
                        <input class="validatebtn" type="submit" value="valider"></input>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </section>
          </div>
        </section>
      </div>
      <!-- Ligne-->
      <div class="card-deck">
        @foreach ($lesOffres as $offre)
          <a href="{{route('frontoffre', ['id'=>$offre->id])}}">
            <div class="container">
              <section class="row">
                <section class="content">
                  <div class="container-fluid">
                    <div class="card card-primary card-outline">
                      <div class="card-header">
                        <h3 class="card-title">{{$offre->titre}}</h3>
                      </div>
                      <div class="card-body">
                        <label>{{$offre->entreprise->nom}}</label>
                        <label>{{$offre->titre}}</label>
                        <label>{{$offre->entreprise->ville}}</label><br>
                        <label>{{$offre->niveau}}</label><br>
                        <label>{{$offre->description}}</label><br>
                      </div>
                    </div>
                  </div>
                </section>
              </section>
            </div>
          </a>
        @endforeach
      </div>
      @stop
