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
        return View('v_accueil', compact('user'));
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

        $moisPost = Input::get('mois');
        $user = Auth::user();
        $mois = substr($moisPost, 3, 8) . substr($moisPost, 0, 2);
        $fiche = DB::table('fichefrais')->where('idvisiteur', $user->id)->where('mois', $mois)->get();

        // Variables de retour
        $numMois = substr($moisPost, 0, 2);
        $numAnnee = substr($moisPost, 3, 8);

        $libEtat = DB::table('etat')->select('libelle')->where('id', $fiche->idetat)->get();

        dd($libEtat);
        //return View('v_afficherFicheFrais', compact('mois'));
    }


}
