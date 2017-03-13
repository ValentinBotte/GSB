<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
        $moisAnnee = $annee . $mois;
        $user = Auth::user();

        $lesFraisForfait = DB::table('lignefraisforfait')->select('idvisiteur')->join('fraisforfait', 'fraisforfait.id', '=', 'lignefraisforfait.idfraisforfait')->where('idvisiteur', $user->id)->where('mois', $moisAnnee)->orderBy('lignefraisforfait.mois', 'desc')->get();
        $lesFraisHorsForfait = DB::table('lignefraishorsforfait')->where('idvisiteur', $user->id)->where('mois', $moisAnnee)->get();
        return View('v_listeFrais', compact('mois','annee','lesFraisForfait','lesFraisHorsForfait'));
    }

    public function ajoutFraisForfait(){

        return $this->afficherRf();
    }
}
