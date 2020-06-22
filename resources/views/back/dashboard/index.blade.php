@extends('layouts.templateBack')
@section('titre')
   Dashboard
@stop

@section('contenu')
  <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$lesUsers->count()}}</h3>

                <p>Utilisateurs</p>
              </div>
              <div class="icon">
                <i class="fas fa-user"></i>
              </div>
              <a href="{{ route('utilisateur.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{$lesEntreprises->count()}}</h3>

                <p>Entreprise</p>
              </div>
              <div class="icon"> 
                <i class="fas fa-building"></i>
              </div>
              <a href="{{ route('entreprise.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{$lesOffres->count()}}</h3>

                <p>Offre en ligne </p>
              </div>
              <div class="icon">
                  <i class="fas fa-globe-europe"></i>
              </div>
              <a href="{{ route('offre.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <?php
                $fp=fopen("compteur.txt","a+");
                $num= fgets($fp,4096);
                ?>
                <h3>{{$num}}</h3>

                <p>Offre visité</p>
              </div>
              <div class="icon">
                  <i class="fas fa-eye"></i>
              </div>
              <a href="{{ route('offre.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
@endsection
