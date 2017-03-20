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
                <div class="form-group">
                    <label for="lstVisiteur" accesskey="n">Visiteurs : </label>
                    <select id="lstVisiteur" name="visiteur" class="form-control">

                        @foreach ($lesVisiteurs as $unVisiteur)
                            <option value="{{ $unVisiteur->id }}">{{ $unVisiteur->name }}</option>
                        @endforeach

                    </select>
                </div>
                <div class="form-group">
                    <label for="lstMois" accesskey="n">Mois : </label>
                    <select id="lstMois" name="mois" class="form-control">

                        @foreach ($afficheMois as $unMois)
                            <option value="{{ $unMois }}">{{ $unMois }}</option>
                        @endforeach

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
            <div class="panel panel-info">
                <div class="panel-heading"><h3>Eléments forfaitisés</h3></div>
                <table class="table table-bordered table-responsive">
                    <thead>
                    <tr>
                        <th class="ETP">libelle</th>
                        <th class="KM">quantité</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($lesFraisForfait as $unFraisForfait)
                        <tr>
                            <td>{{$unFraisForfait->libelle}}</td>
                            <td>{{$unFraisForfait->quantite}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
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

    <script src="{{asset('js/ajax.js')}}"></script>

@endsection

