@extends('layouts.app')

@section('content')


    <div class="header">
        <div class="row vertical-align">
            <div class="col-md-4">
                <h1><img src="./images/logo.jpg" class="img-responsive" alt="Laboratoire Galaxy-Swiss Bourdin" title="Laboratoire Galaxy-Swiss Bourdin"></h1>
            </div>
            <div class="col-md-8">
                <ul class="nav nav-pills pull-right" role="tablist">
                    <li <?php if (!isset($_REQUEST['uc']) || $_REQUEST['uc'] == 'accueil') { ?> class="active"<?php } ?>><a href="index.php">Accueil</a></li>
                    <li <?php if (isset($_REQUEST['uc']) && $_REQUEST['uc'] == 'gererFrais') { ?> class="active"<?php } ?>><a href="index.php?uc=gererFrais&action=saisirFrais"><span class="glyphicon glyphicon-pencil"></span> Renseigner la fiche de frais</a></li>
                    <li <?php if (isset($_REQUEST['uc']) && $_REQUEST['uc'] == 'etatFrais') { ?> class="active"<?php } ?>><a href="index.php?uc=etatFrais&action=selectionnerMois"><span class="glyphicon glyphicon-list-alt"></span> Afficher mes fiches de frais</a></li>
                    <li <?php if (isset($_REQUEST['uc']) && $_REQUEST['uc'] == 'deconnexion') { ?> class="active"<?php } ?>><a href="{{ url('deconnexion') }}">Déconnexion</a></li>
                </ul>
            </div>
        </div>
    </div>

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
                        <a href="index.php?uc=gererFrais&action=saisirFrais" class="btn btn-success btn-lg" role="button"><span class="glyphicon glyphicon-pencil"></span> <br/>Renseigner la fiche de frais</a>
                        <a href="index.php?uc=etatFrais&action=selectionnerMois" class="btn btn-primary btn-lg" role="button"><span class="glyphicon glyphicon-list-alt"></span> <br/>Afficher mes fiches de frais</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
