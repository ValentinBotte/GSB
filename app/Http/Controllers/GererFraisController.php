<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

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
        $moisAnnee = '200101';
        $user = Auth::user();
        $lesFraisForfait = DB::table('lignefraisforfait')->join('fraisforfait', 'fraisforfait.id', '=', 'lignefraisforfait.idfraisforfait')->where('idvisiteur', $user->id)->where('mois', $moisAnnee)->orderBy('lignefraisforfait.mois', 'desc')->get();
        $lesFraisHorsForfait = DB::table('lignefraishorsforfait')->where('idvisiteur', $user->id)->where('mois', $moisAnnee)->get();
        return View('v_listeFrais', compact('mois','annee','lesFraisForfait','lesFraisHorsForfait'));
    }

    public function ajoutFraisForfait(){
        $moisAnnee = '200101';
        $user = Auth::user();
        $dateFrais = Input::get('dateFrais');
        $libelle = Input::get('libelle');
        $montant = Input::get('montant');
        DB::table('lignefraishorsforfait')->insert(
            ['idvisiteur' => $user->id, 'mois' => $moisAnnee,  'libelle' => $libelle, 'date' => $dateFrais, 'montant' => $montant]
        );
        return $this->afficherRf();
    }
}
