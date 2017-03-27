﻿@extends('layouts.app')

@section('content')

<div id="accueil">
    <h2>Gestion des frais<small> - Visiteur : {{ $user->prenom }} {{ $user->name }}</small></h2>
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
                        <a href="{{ url('afficher_renseigner_frais') }}" class="btn btn-success btn-lg" role="button"><span class="glyphicon glyphicon-pencil"></span> <br/>Renseigner la fiche de frais</a>
                        <a href="{{ url('afficher_fiche_de_frais') }}" class="btn btn-primary btn-lg" role="button"><span class="glyphicon glyphicon-list-alt"></span> <br/>Afficher mes fiches de frais</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection