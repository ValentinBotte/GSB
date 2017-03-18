<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class AccueilController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /*
     *  INDEX
     */
    public function index(){
        $user = Auth::user();
        if($user->comptable == 0){
            return View('v_accueil', compact('user'));
        }else{
            return View('v_accueilComptable', compact('user'));
        }

    }


    /*
     *  CONTROLER AFFICHAGE FICHE DE FRAIS
     */
    public function afficherFdf(){

        $user = Auth::user();
        $mois = DB::table('fichefrais')->select('mois')->where('idvisiteur', $user->id)->orderBy('mois', 'desc')->get();

        foreach($mois as $unMois){
            $tempMois = substr($unMois->mois, 4, 6) . '/' . substr($unMois->mois, 0, 4);
            $unMois->mois = $tempMois;
        }

        return View('v_afficherFicheFrais', compact('mois'));
    }

    /*
     *  CONTROLER AFFICHAGE FICHE DE FRAIS POST
     */
    public function afficherFdfPost(){

        $user = Auth::user();

        //Ancienne variable pour affFdf
        $mois = DB::table('fichefrais')->select('mois')->where('idvisiteur', $user->id)->orderBy('mois', 'desc')->get();
        foreach($mois as $unMois){
            $tempMois = substr($unMois->mois, 4, 6) . '/' . substr($unMois->mois, 0, 4);
            $unMois->mois = $tempMois;
        }

        $moisPost = Input::get('mois');
        $leMois = substr($moisPost, 3, 8) . substr($moisPost, 0, 2);
        $fiche = DB::table('fichefrais')->where('idvisiteur', $user->id)->where('mois', $leMois)->get();

        // Variables de retour
        $numMois = substr($moisPost, 0, 2);
        $numAnnee = substr($moisPost, 3, 8);

        $libEtat = DB::table('etat')->select('libelle')->where('id', $fiche[0]->idetat)->get()[0]->libelle;
        $dateModif = $fiche[0]->datemodif;
        $lesFraisForfait = DB::table('lignefraisforfait')->join('fraisforfait', 'fraisforfait.id', '=', 'lignefraisforfait.idfraisforfait')->where('idvisiteur', $user->id)->where('mois', $leMois)->orderBy('lignefraisforfait.mois', 'desc')->get();
        $lesFraisHorsForfait = DB::table('lignefraishorsforfait')->where('idvisiteur', $user->id)->where('mois', $leMois)->get();
        return View('v_afficherFicheFrais', compact('numMois', 'numAnnee', 'libEtat', 'dateModif', 'mois','lesFraisHorsForfait','lesFraisForfait'));
    }


}
