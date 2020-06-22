@extends('layouts.templateBack')
@section('titre')
   Liste des Utilisateurs
@stop

@section('contenu')
  <a href="{{route('utilisateur.create')}}">
      <button style='margin-left:10px;' type="submit" class="btn btn-primary">
      Ajouter un utilisateur
      </button>
  </a>
  <br> </br>

  @include('back.alert-message')

<table class="table table-sm" id="table_id">
    <thead>
      <tr>
          <th>ID</th>
          <th scope="col">Nom</th>
          <th scope="col">Email</th>
          <th scope="col">Statut</th>
          <th scope="col">Entreprise</th>
          <th scope="col" class="text-right">Action</th>
      </tr>
    </thead>
    <tbody>
    @foreach($lesUtilisateurs as $user)
      <tr>
        <td> {{$user->id}} </td>
        <td> {{$user->name}} </td>
        <td> {{$user->email}} </td>
        <td> {{$user->statut}} </td>
        <td> @if ($user->entreprise_id)
          {{$user->entreprise->nom}}
        @endif
        </td>
        <td class="td-actions text-right">
            <div style="display: inline-flex;">
        <form action="{{route('utilisateur.edit', $user->id)}}" style="margin-left = 10px;"method="POST">
            @csrf
            @method('GET')
          <button type="submit" rel="tooltip" class="btn btn-success btn-round">
              <i class="material-icons">Modifier</i>
          </button>
        </form>
            <form action="{{route('utilisateur.destroy', $user->id)}}" method="POST">
            @csrf
            @method('DELETE')
          <button type="submit" rel="tooltip" class="btn btn-danger btn-round" onclick="return confirm('Est tu sur de vouloir supprimer cet utilisateur ?')">
              <i class="material-icons">Supprimer</i>
          </button>
            </form>
          </div>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
@stop

@section('script')
  <script>
  $(document).ready(function() {
          $('#table_id').DataTable({

              "language": {
                  "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
              }
          });
      });
  </script>
@stop
