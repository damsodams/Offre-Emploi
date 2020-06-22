@extends('layouts.templateBack')
@section('titre')
   Liste des Entreprises
@stop

@section('contenu')
<table class="table table-sm" id="table_id">

    <a href="{{route('entreprise.create')}}">
        <button style='margin-left:10px;' type="submit" class="btn btn-primary">
        Ajouter une entreprise
        </button>
    </a>
    <br> </br>

    @include('back.alert-message')

    <thead>
      <tr>
          <th scope="col">ID</th>
          <th scope="col">Nom</th>
          <th scope="col">Ville</th>
          <th scope="col">Code Postal</th>
          <th scope="col">Adresse</th>
          <th scope="col">Contact</th>
          <th scope="col">Téléphone</th>
          <th scope="col">Mail</th>
          <th scope="col" class="text-right">Action</th>
      </tr>
    </thead>
    <tbody>

    @foreach($lesEntreprises as $entreprise)
      <tr>

        <td> {{$entreprise->id}} </td>
        <td> {{$entreprise->nom}} </td>
        <td> {{$entreprise->ville}} </td>
        <td> {{$entreprise->codePostal}} </td>
        <td> {{$entreprise->adresse}} </td>
        <td> {{$entreprise->contact}} </td>
        <td> {{$entreprise->telephone}} </td>
        <td> {{$entreprise->mail}} </td>

        <td class="td-actions text-right">
            <div style="display: inline-flex;">
        <form action="{{route('entreprise.edit', $entreprise->id)}}" method="POST">
            @csrf
            @method('GET')
          <button type="submit" rel="tooltip" class="btn btn-success btn-round">
              <i class="material-icons">Modifier</i>
          </button>
        </form>
            <form action="{{route('entreprise.destroy', $entreprise->id)}}" method="POST">
            @csrf
            @method('DELETE')
          <button type="submit" rel="tooltip" class="btn btn-danger btn-round" onclick="return confirm('Est tu sur de vouloir supprimer cette entreprise ?')">
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
