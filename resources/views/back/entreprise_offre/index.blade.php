@extends('layouts.templateBack')
@section('titre')
{{ $entrepriseName }}
@stop

@section('contenu')
<table class="table table-sm" id="table_id">

      <a href="{{route('offres_entreprise.create')}}">
          <button style='margin-left:10px;' type="submit" class="btn btn-primary">
          Ajouter une offre
          </button>
      </a>
      <br> </br>

    @include('back.alert-message')

    <thead>
      <tr>
          <th scope="col">ID</th>
          <th scope="col">Titre</th>
          <th scope="col">Intitulé</th>
          <th scope="col">Secteur</th>
          <th scope="col">Description</th>
          <th scope="col">Niveau</th>
          <th scope="col">Contrat</th>
          <th scope="col">PDF</th>
          <th scope="col">Salaire</th>
          <th scope="col" class="text-right">Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($lesOffres as $offre)
        <tr>

            <td> {{$offre->id}}</td>
            <td> {{$offre->titre}}</td>
            <td> {{$offre->intitule_poste}}</td>
            <td> {{$offre->secteur}}</td>
            <td> {{$offre->description}}</td>
            <td> {{$offre->niveau}}</td>
            <td> {{$offre->type_contrat}}</td>
            <?php
              $value = $offre->pdf;
              $rest = substr($value, 17);
              echo "<td>";
              echo $rest;
              if($rest == NULL){echo 'No file selected';};
              echo "</td>";
            ?>
            <td> {{$offre->salaire}}</td>

            <td class="td-actions text-right">
                <div style="display: inline-flex;">
            <form action="{{route('offres_entreprise.edit', $offre->id)}}" method="POST">
              @csrf
              @method('GET')
              <button type="submit" rel="tooltip" class="btn btn-success btn-round">
                  <i class="material-icons">Modifier</i>
              </button>
            </form>
            <form action="{{route('offres_entreprise.destroy', $offre->id)}}" method="POST">
                @csrf
                @method('DELETE')
              <button type="submit" rel="tooltip" class="btn btn-danger btn-round" onclick="return confirm('Est tu sur de vouloir supprimer cette offre ?')">
                  <i class="material-icons">Supprimer</i>
              </button>
            </form>
            <form action="{{route('offres_entreprise.show', $offre->id)}}" method="POST">
                @csrf
                @method('GET')
              <button type="submit" rel="tooltip" class="btn btn-info btn-dark">
                  <i class="material-icons">Voir</i>
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
            },
            "order": [[ 0, "desc" ]],
        });
    });
</script>
@stop
