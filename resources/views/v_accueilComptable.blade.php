@extends('layouts.appComptable')

@section('content')

<div id="accueil">
    <h2>Gestion des fiches de frais<small> - Comptable : {{ $user->prenom }} {{ $user->name }}</small></h2>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <span class="glyphicon glyphicon-bookmark"></span> Navigation</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <a href="{{ url('afficher_valide_frais') }}" class="btn btn-success btn-lg" role="button"><span class="glyphicon glyphicon-pencil"></span> <br/>Validation d’une fiche de frais</a>
                        <a href="{{ url('afficher_suivi_frais') }}" class="btn btn-primary btn-lg" role="button"><span class="glyphicon glyphicon-list-alt"></span> <br/>Suivi du paiement des fiches de frais</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


