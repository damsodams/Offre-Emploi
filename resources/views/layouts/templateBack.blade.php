<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Back-Office</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{url('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{url('css/adminlte.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- DATATABLE -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.css"/>

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->

    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('front')}}" class="nav-link">Accueil</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          <i class="fas fa-sign-out-alt"></i> Se déconnecter</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
      </li>
    </ul>
  </nav>
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <?php
      $statut = auth()->user();
      $statut = $statut->statut;
      ?>
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          @if ($statut == "Administrateur")
            <li class="nav-item">
              <a href="{{ route('dashboard.index')}}" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>
          <li class="nav-item">
            <a href="{{ route('offre.index')}}" class="nav-link">
              <i class="nav-icon fas fa-archive"></i>
              <p>
                Gestion Offres
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('entreprise.index')}}" class="nav-link">
              <i class="nav-icon fas fa-building"></i>
              <p>
                Gestion Entreprises
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('utilisateur.index')}}" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Gestion Utilisateurs
              </p>
            </a>
          </li>
        @endif
        @if ($statut == "Entreprise")
        <li class="nav-item">
          <a href="{{ route('offres_entreprise.index')}}" class="nav-link">
            <i class="nav-icon fas fa-archive"></i>
            <p>
              Gestion Offres
            </p>
          </a>
        </li>
      @endif
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            <p style='margin: auto; font-size:40px;'><b>
@section("titre")
@show

            </b></p>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>


    <!-- Main content -->
    @section("contenu")

    @show
    <!-- /.content -->
  </div>

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{url('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{url('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{url('js/adminlte.min.js')}}"></script>
<!-- DATATABLE -->
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.js"></script>

@yield("script")

</body>
</html>
