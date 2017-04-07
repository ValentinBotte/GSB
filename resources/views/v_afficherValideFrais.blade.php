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
                        @foreach ($lesVisiteurs as $unVisiteur)
                            @if(!empty($visiteur2) and $visiteur2[0]->id == $unVisiteur->id)
                                <option value="{{ $visiteur2[0]->id }}" selected="selected">{{ $visiteur2[0]->name }}</option>
                            @else
                                <option value="{{ $unVisiteur->id }}">{{ $unVisiteur->name }}</option>
                            @endif
                        @endforeach

                    </select>
                </div>
                <div class="form-group">
                    <label for="lstMois" accesskey="n">Mois : </label>
                    <select id="lstMois" name="mois" class="form-control">
                    @if(!empty($afficheMois))
                        @foreach ($afficheMois as $unMois)
                                @if(!empty($mois) and $mois == $unMois)
                                    <option value="{{ $mois }}" selected="selected">{{ $mois }}</option>
                                @else
                                    <option value="{{ $unMois }}">{{ $unMois }}</option>
                                @endif
                        @endforeach
                    @endif

                    </select>
                </div>
                <input id="ok" type="submit" name="submit" value="Valider" class="btn btn-success" role="button" />
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
                <form method="post" action="{{ url("afficher_valide_frais/update") }}" role="form">
                    {{ csrf_field() }}
                    <fieldset>
                        @foreach ($lesFraisForfait as $unFrais)
                            @if( $unFrais->libelle != 'Forfait Etape' and $unFrais->libelle != 'Nuitée Hôtel' and $unFrais->libelle != 'Repas Restaurant')
                                <div class="form-group">
                                    <label for="idFrais">Nombre de km</label>
                                    <input type="text" id="idFrais" name="lesFrais{{ $unFrais->idfraisforfait }}" size="10" maxlength="5" value="{{ $unFrais->quantite }}" class="form-control">
                                </div>
                            @else
                                <div class="form-group">
                                    <label for="idFrais">{{ $unFrais->libelle }}</label>
                                    <input type="text" id="idFrais" name="lesFrais{{ $unFrais->idfraisforfait }}" size="10" maxlength="5" value="{{ $unFrais->quantite }}" class="form-control">
                                </div>
                            @endif
                        @endforeach
                        <button class="btn btn-success" type="submit">Valider</button>
                    </fieldset>
                </form>
            </div>
        </div>
        </br>
        </br>
        <div class="row">
            <div class="panel panel-info">
                <div class="panel-heading"><h3>Eléments hors forfait</h3></div>
                <table class="table table-bordered table-responsive">
                    <thead>
                    <tr>
                        <th class="date">Date</th>
                        <th class="libelle">Libellé</th>
                        <th class="montant">Montant</th>
                        <th class="delete">Supprimer</th>
                        <th class="report">Reporter</th>
                    </tr>
                    </thead>


                        <tbody>
                        @foreach ($lesFraisHorsForfait as $unFraisHorsForfait)
                            <tr>
                                <form method="post" action="" role="form">
                                    {{ csrf_field() }}
                                    <td>{{$unFraisHorsForfait->date}}</td>
                                    <td>{{$unFraisHorsForfait->libelle}}</td>
                                    <td>{{$unFraisHorsForfait->montant}}</td>
                                    <input type="hidden" name="id" value="{{ $unFraisHorsForfait->id }}" />
                                    <td><input type="submit" value="supprimer" name="submit" class="btn btn-danger" onclick="return confirm('Voulez-vous vraiment supprimer ce frais?');"></td>
                                    <td><input type="submit" value="reporter" name="submit" class="btn btn-warning" onclick="return confirm('Voulez-vous vraiment reporter ce frais?');"></td>
                                </form>
                            </tr>
                        @endforeach
                        </tbody>
                </table>
            </div>
        </div>
        <a href="{{ url('afficher_valide_frais/valider') }}" class="btn btn-primary" role="button">Valider fiche de frais</a>
        </br>
        </br>
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


