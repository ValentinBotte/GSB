<html>

<head>
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>

<header>
    <div style="margin-top: 30px;">
        <center><img src="logo.png" /></center>
    </div>
</header>

<body>
<center>
    <div id="entete" style="margin-left: 50px;">
        REMBOURSEMENT DE FRAIS ENGAGES
    </div>

    <div id="tableau">
        <div id="body" style="margin-left: 50px;">
            <p style="text-align: left; margin-left: 20px; margin-top: 40px;"><b>Visiteur : </b>{{ $user->id }} {{ $user->prenom }} {{ $user->name }}</p>
            <p style="text-align: left; margin-left: 20px; margin-bottom: 40px;"><b>Mois : </b>{{ $numMois }} {{ $numAnnee }}</p>

            <!--DIV TABLEAU-->

            <!-- TABLEAU -->
            <table border="1" style="margin-left: 25px;">
                <thead>
                <tr>
                    <th>Frais Forfaitaires</th>
                    <th>Quantité</th>
                    <th>Montant unitaire</th>
                    <th>Total</th>
                </tr>
                </thead>
                @foreach ($lesFraisForfait as $unFraisForfait)

                    @if( $unFraisForfait->libelle != 'Forfait Etape' and $unFraisForfait->libelle != 'Nuitée Hôtel' and $unFraisForfait->libelle != 'Repas Restaurant')
                        <tr>
                            <td>Nombre de km</td>
                            <td>{{$unFraisForfait->quantite}}</td>
                            <td>{{$unFraisForfait->montant}}</td>
                            <td>{{ $unFraisForfait->quantite*$unFraisForfait->montant }}</td>
                        </tr>
                    @else
                        <tr>
                            <td>{{$unFraisForfait->libelle}}</td>
                            <td>{{$unFraisForfait->quantite}}</td>
                            <td>{{$unFraisForfait->montant}}</td>
                            <td>{{ $unFraisForfait->quantite*$unFraisForfait->montant }}</td>
                        </tr>
                        @endif
                @endforeach

                </tbody>
            </table>


            <br>
            <p style="color: #1F497D; margin-top: 30px;"><i>Autres Frais</i></p>

            <table border="1" style="margin-bottom: 100px; margin-left: 25px;">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Libellé</th>
                    <th>Montant</th>
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

            <table border="1" style="width: auto; margin-left: auto; margin-top: -50px; margin-bottom: 25px; margin-right: 140px;">
                <tr>
                    <td style="padding:5px">Total {{$numMois}}/{{$numAnnee}}</td>
                    <td style="padding:5px; padding-left: 15px">{{ $total }}</td>
                </tr>
            </table>
        </div>
    </div>



    <div style="margin-left: 400px; margin-top: 50px;">
        <p>Fait à Paris, le 7 janvier 2017</p> <p style="margin-right: 50px;"> Vu l'agent comptable</p>

        <img src="signature.png">
    </div>
</center>
</body>


</html>