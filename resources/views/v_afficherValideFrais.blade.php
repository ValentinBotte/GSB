@extends('layouts.appComptable')

@section('content')
    <h2>Validation d'une fiche de frais</h2>
    <div class="row">
        <div class="col-md-4">
            <h3>Sélectionner un mois et un visiteur : </h3>
        </div>
        <div class="col-md-4">
            <form action="" method="post" role="form">
                {{ csrf_field() }}
                <div class="form-group"><br>
                    <select id="lstVisiteur" name="visiteur" class="form-control">

                        <option value="" disabled selected>Choisir un visiteur</option>
                        @if(!empty($visiteur2))
                            <option value="{{ $visiteur2[0]->id }}" selected="selected">{{ $visiteur2[0]->name }}</option>
                        @endif
                        @foreach ($lesVisiteurs as $unVisiteur)
                            <option value="{{ $unVisiteur->id }}">{{ $unVisiteur->name }}</option>
                        @endforeach

                    </select>
                </div>
                <div class="form-group">
                    <label for="lstMois" accesskey="n">Mois : </label>
                    <select id="lstMois" name="mois" class="form-control">
                        @if(!empty($mois))
                            <option value="{{ $mois }}" selected="selected">{{ $mois }}</option>
                        @endif

                    @if(!empty($afficheMois))
                        @foreach ($afficheMois as $unMois)
                            <option value="">{{ $unMois }}</option>
                        @endforeach
                    @endif

                    </select>
                </div>
                <input id="ok" type="submit" value="Valider" class="btn btn-success" role="button" />
                <input id="annuler" type="reset" value="Effacer" class="btn btn-danger" role="button" />
            </form>
        </div>
    </div>
@endsection

@section('content_secondary')

    @if( ! empty($anneeMois))
        <hr>
        <div class="panel panel-primary">
            <div class="panel-heading">Fiche de frais du mois {{ $numMois }} - {{ $numAnnee }} : </div>
            <div class="panel-body">
                <strong><u>Etat :</u></strong> {{ $etat }} depuis le {{ $dateModif }} <br>

            </div>
        </div>
        <div class="row">
            <h3>Eléments forfaitisés</h3>
            <div class="col-md-4">
                <form method="post" action="{{ url("afficher_valide_frais/$visiteur") }}" role="form">
                    {{ csrf_field() }}
                    <fieldset>
                        @foreach ($lesFraisForfait as $unFrais)
                            <div class="form-group">
                                <label for="idFrais">{{ $unFrais->libelle }}</label>
                                <input type="text" id="idFrais" name="lesFrais{{ $unFrais->idfraisforfait }}" size="10" maxlength="5" value="{{ $unFrais->quantite }}" class="form-control">
                            </div>
                        @endforeach
                        <button class="btn btn-success" type="submit">Valider</button>
                    </fieldset>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="panel panel-info">
                <div class="panel-heading"><h3>Eléments hors forfait</h3></div>
                <table class="table table-bordered table-responsive">
                    <thead>
                    <tr>
                        <th class="date">Date</th>
                        <th class="libelle">Libellé</th>
                        <th class="montant">Montant</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($lesFraisHorsForfait as $unFraisHorsForfait)
                        <tr>
                            <td>{{$unFraisHorsForfait->date}}</td>
                            <td>{{$unFraisHorsForfait->libelle}}</td>
                            <td>{{$unFraisHorsForfait->montant}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif


    <script>

        $("#lstVisiteur").change(function() {

            var idVisiteur = $("#lstVisiteur option:selected").val();

            $.get('{{ url('afficher_valide_frais') }}/getMois?idVisiteur=' + idVisiteur, function(data) {

                $('#lstMois').empty();

                for(var i = 0; i < data.length; i++){
                    $('#lstMois').append(
                        $('<option></option>').val(data[i]).html(data[i])
                    );
                }

            });

        });

    </script>

@endsection

