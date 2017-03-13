<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GererFraisController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    /*
     *  CONTROLLER AFFICHAGE RENSEIGNER FICHE DE FRAIS
     */
    public function afficherRf(){
        $mois = date("m");
        $annee = date("Y");
        $idVisiteur = $_SESSION['idVisiteur'];
        $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $mois);
        return View('v_listeFraisForfait', compact('mois','annee'));
    }
}
