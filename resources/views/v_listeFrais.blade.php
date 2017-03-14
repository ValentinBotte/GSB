@extends('layouts.app')

@section('content')
    <div class="row">
        <h2>Renseigner ma fiche de frais du mois {{ $mois }} - {{ $annee }}</h2>
        <h3>Eléments forfaitisés</h3>
        <div class="col-md-4">
            <form method="post" action="" role="form">
                {{ csrf_field() }}
                <fieldset>
                    @foreach ($lesFraisForfait as $unFrais)
                            <div class="form-group">
                                <label for="idFrais">{{ $unFrais->libelle }}</label>
                                <input type="text" id="idFrais" name="lesFrais[{{ $unFrais->idfraisforfait }}]" size="10" maxlength="5" value="{{ $unFrais->quantite }}" class="form-control">
                            </div>
                    @endforeach
                    <button class="btn btn-success" type="submit">Ajouter</button>
                    <button class="btn btn-danger" type="reset">Effacer</button>
                </fieldset>
            </form>
        </div>
    </div>
@endsection


@section('content_secondary')
    <div class="row">
        <div class="panel panel-info">
            <div class="panel-heading">Descriptif des éléments hors forfait</div>
            <table class="table table-bordered table-responsive">
                <thead>
                <tr>
                    <th class="date">Date</th>
                    <th class="libelle">Libellé</th>
                    <th class="montant">Montant</th>
                    <th class="action">&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($lesFraisHorsForfait as $unFraisHorsForfait)
                <tr>
                    <td>{{$unFraisHorsForfait->date}}</td>
                    <td>{{$unFraisHorsForfait->libelle}}</td>
                    <td>{{$unFraisHorsForfait->montant}}</td>
                    <td><a href="{{ url("afficher_renseigner_frais/$unFraisHorsForfait->id") }}"
                           onclick="return confirm('Voulez-vous vraiment supprimer ce frais?');">Supprimer ce frais</a></td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <h3>Nouvel élément hors forfait</h3>
        <div class="col-md-4">
            <form action="{{ url('afficher_renseigner_frais') }}" method="post" role="form">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="txtDateHF">Date (jj/mm/aaaa): </label>
                    <input type="text" id="txtDateHF" name="dateFrais" class="form-control" id="text">
                </div>
                <div class="form-group">
                    <label for="txtLibelleHF">Libellé</label>
                    <input type="text" id="txtLibelleHF" name="libelle" class="form-control" id="text">
                </div>
                <div class="form-group">
                    <label for="txtMontantHF">Montant : </label>
                    <div class="input-group">
                        <span class="input-group-addon">€</span>
                        <input type="text" id="txtMontantHF" name="montant" class="form-control" value="">
                    </div>
                </div>
                <button class="btn btn-success" type="submit">Ajouter</button>
                <button class="btn btn-danger" type="reset">Effacer</button>
            </form>
        </div>
    </div>
@endsection