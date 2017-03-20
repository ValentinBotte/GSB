<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Intranet du Laboratoire Galaxy-Swiss Bourdin</title>
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="../css/bootstrap.css" rel="stylesheet" type="text/css" />

</head>


    <body>
        <div class="container">
          <br>
            <div class="header">
                <div class="row vertical-align">
                    <div class="col-md-4">
                        <h1><img src="../public/images/logo.jpg" class="img-responsive" alt="Laboratoire Galaxy-Swiss Bourdin" title="Laboratoire Galaxy-Swiss Bourdin"></h1>
                    </div>
                    <div class="col-md-8">
                        <ul class="nav nav-pills pull-right" role="tablist">
                            <li><a href="../public/">Accueil</a></li>
                            <li><a href="{{ url('afficher_renseigner_frais') }}"><span class="glyphicon glyphicon-pencil"></span> Renseigner la fiche de frais</a></li>
                            <li><a href="{{ url('afficher_fiche_de_frais') }}"><span class="glyphicon glyphicon-list-alt"></span> Afficher mes fiches de frais</a></li>
                            <li><a href="{{ url('deconnexion') }}">Déconnexion</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

            @yield('content')

            @yield('content_secondary')



        </div>

    </body>
</html>