@extends('layouts.templateAut')
@section('contenu')
<div class="login100-pic js-tilt" data-tilt>
	<img src="{{url('images/logo.png')}}" alt="IMG">
</div>

<form  method="POST" action="{{ route('login') }}" class="login100-form validate-form">
@csrf
	<span class="login100-form-title">
			Connexion au portail HDA
	</span>
		<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
			<input id="email" type="email" class="input100{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus placeholder="Email">
							@error('email')
	            	<span class="invalid-feedback" role="alert">
	              	<strong>{{ $message }}</strong>
	              </span>
	            @enderror
								<span class="focus-input100"></span>
								<span class="symbol-input100">
								<i class="fa fa-envelope" aria-hidden="true"></i>
								</span>
		</div>

		<div class="wrap-input100 validate-input" data-validate = "Password is required">
			<input id="password" type="password" class="input100{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Mot de passe" required>
								@error('password')
									<span class="invalid-feedback" role="alert">
								  	<strong>{{ $message }}</strong>
								  </span>
								@enderror
									<span class="focus-input100"></span>
									<span class="symbol-input100">
										<i class="fa fa-lock" aria-hidden="true"></i>
									</span>
		</div>

		<div class="container-login100-form-btn">
			<button type="submit" class="login100-form-btn">
					Se connecter
			</button>
		</div>

		<div class="text-center p-t-12">
			</span>
				<a class="txt2" href="{{ route('password.request') }}">
					Mot de passe oublié ?
				</a>
		</div>
</form>
@stop
