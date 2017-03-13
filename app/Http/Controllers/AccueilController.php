<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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


}
