@extends('layouts.templateFront')
@section('contenu')
  <!-- general form elements disabled -->
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

  <form method="POST" action="{{route('config.update', $user->id)}}">
  @csrf
  @method('PUT')
    <div>
      <input type="checkbox" id="emailBox" name="emailBox" onclick="change_email();">
      <label>Changer l'adresse email</label><br>
      <input type="checkbox" id="mdpBox" name="mdpBox" onclick="change_mdp();">
      <label>Changer de mot de passe</label><br>
    </div><br>
    <div class="form-group">
      <label >Adresse mail</label>
      <input type="email" class="form-control" id="adresseMail" name="adresseMail" value="{{ $user->email}}">
    </div>
    <div class="form-group">
      <label>Mot de passe</label>
      <input id="password" type="password" class="form-control" name="password" placeholder="Mot de passe" required>
        @error('password')
           <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
                </span>
        @enderror
    </div>
    <div class="form-group" id="formNewMdp"> 
                  
    </div>
    <div class="form-group" id="formAgainNewMdp">
    
    </div>
    <div class="container-login100-form-btn">
			<button type="submit" class="login100-form-btn">
					Mettre à jour
			</button>
		</div>

    <script>
    document.getElementById("adresseMail").disabled = true;

    function change_email(){
      checkBoxEmail = document.getElementById("emailBox");
      ;
      if (checkBoxEmail.checked == true) {
        document.getElementById("adresseMail").disabled = false;

        document.getElementById("mdpBox").checked = false;
        change_mdp();
      }
      else{
        document.getElementById("adresseMail").disabled = true;
      }
    }

    function change_mdp() {
      checkBoxMdp = document.getElementById("mdpBox");

      if (checkBoxMdp.checked == true) {
        document.getElementById("emailBox").checked = false;
        change_email();

        newMdp = document.createElement('input'); //on crée l'élément (la balise) input
        againNewMdp = document.createElement('input'); //on crée l'élément (la balise) input
        
        newMdp.type = 'password';
        againNewMdp.type = 'password';

        newMdp.id = 'newMdp'; //on définit l'attribut id du input
        againNewMdp.id = 'againNewMdp'; //on définit l'attribut id du 
        
        newMdp.name = 'newMdp'; 
        againNewMdp.name = 'againNewMdp'; 

        newMdp.classList.add("form-control");
        againNewMdp.classList.add("form-control");

        newMdp.placeholder='Nouveau mot de passe';
        againNewMdp.placeholder='Nouveau mot de passe';

        oFormNewMdp = document.getElementById('formNewMdp'); //on récupère le noeud formulaire
        oFormAgainNewMdp = document.getElementById('formAgainNewMdp'); //on récupère le noeud formulaire

        oFormNewMdp.appendChild(newMdp);//on place le input dans le formulaire
        oFormAgainNewMdp.appendChild(againNewMdp);//on place le input dans le formulaire
      
      }else{
        document.getElementById('newMdp').remove();
        document.getElementById('againNewMdp').remove();
      }
    }
    </script>
  </form>


@stop
