</html>
<!DOCTYPE html>
<html lang="fr">
<head>
	<title>HDA</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="{{url('images/favicon.ico')}}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{url('css/bootstrap.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{url('css/font-awesome.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{url('css/animate.css')}}">
<!--===============================================================================================-->
<link rel="stylesheet" href="{{url('css/all.min.css')}}">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="{{url('css/adminlte.min.css')}}">
<!-- Google Font: Source Sans Pro -->
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="{{url('css/select2.min.css')}}">
<!--===============================================================================================-->

	<link rel="stylesheet" type="text/css" href="{{url('css/main.css')}}">
  <!-- Bootstrap CSS -->
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{url('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{url('css/card.css')}}">

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-163820930-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-163820930-1');
</script>

</head>
<body>
  <!-- Navbar -->
<nav style="margin-left: 0px;" class="main-header navbar navbar-expand navbar-white navbar-light">
<!-- SEARCH FORM -->
<li class="nav-item">
	<a class="nav-link" data-widget="control-sidebar" data-slide="true" href="{{route('front')}}" role="button">
<i class="fas fa-home"></i>
	</a>
</li>
<form class="form-inline ml-3" method="post" action="{{route('frontoffrefilter')}}">
	@csrf
<div class="input-group input-group-sm">
  <input class="form-control form-control-navbar" name="search" id="search" type="search" placeholder="Search" aria-label="Search">
  <div class="input-group-append">
    <button class="btn btn-navbar" type="submit">
      <i class="fas fa-search"></i>
    </button>
  </div>
</div>
</form>
<?php $user = auth()->user();?>
<!-- Right navbar links -->
<ul class="navbar-nav ml-auto">

@if ($user->statut == 'Administrateur')
	<!-- Btn back office ADMIN -->
	<li class="nav-item">
	  <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="{{ route('dashboard.index') }}" role="button">
	<i class="fas fa-tools"></i>
	  </a>
	</li>
@endif

@if ($user->statut == 'Entreprise')
	<!-- Btn back office ENTREPRISE -->
	<li class="nav-item">
	  <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="{{ route('offres_entreprise.index') }}" role="button">
			<i class="fas fa-plus-square"></i>
	  </a>
	</li>
@endif

<!-- Btn param user-->
<li class="nav-item">
  <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="{{ route('config.index') }}" role="button">
      <i class="fas fa-cog"></i>
  </a>
</li>
<!-- Btn log out -->
<li class="nav-item">
  <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    <i class="fas fa-sign-out-alt"></i> Se déconnecter</a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      @csrf
  </form>
</li>
</nav>


	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
        <div class="content_card">
          @section('contenu')
          @show
        </div>

			</div>
		</div>
	</div>




<!--===============================================================================================-->
	<script src="{{url('js/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{url('js/popper.js')}}"></script>
	<script src="{{url('js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{url('js/select2.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{url('js/tilt.jquery.min.js')}}"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="{{url('js/main.js')}}"></script>

</body>
</html>
