<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Facades\App;
session_start();
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
        $anneemoins = date('Y') - 1;
        $annee = $anneemoins.date('m');
        $afficheMois = DB::table('fichefrais')->select('mois')->where('idvisiteur', $user->id)->where('mois', '>=',$annee)->orderBy('mois', 'desc')->get();
        foreach($afficheMois as $unMois){
            if(substr($unMois->mois, 0, 4) >= date('Y') - 1) {
                $tempMois = substr($unMois->mois, 4, 6) . '/' . substr($unMois->mois, 0, 4);
                $unMois->mois = $tempMois;
            }
        }


        return View('v_afficherFicheFrais', compact('afficheMois', 'user'));
    }


        /*
         *  CONTROLER AFFICHAGE FICHE DE FRAIS POST
         */
        public function afficherFdfPost(){


        $user = Auth::user();

        //Ancienne variable pour affFdf
            $anneemoins = date('Y') - 1;
            $annee = $anneemoins.date('m');
            $afficheMois = DB::table('fichefrais')->select('mois')->where('idvisiteur', $user->id)->where('mois', '>=',$annee)->orderBy('mois', 'desc')->get();
            foreach($afficheMois as $unMois){
                if(substr($unMois->mois, 0, 4) >= date('Y') - 1) {
                    $tempMois = substr($unMois->mois, 4, 6) . '/' . substr($unMois->mois, 0, 4);
                    $unMois->mois = $tempMois;
                }
            }

        $moisPost = Input::get('mois');
        $leMois = substr($moisPost, 3, 8) . substr($moisPost, 0, 2);
        $_SESSION['mois']=$moisPost;
        $fiche = DB::table('fichefrais')->where('idvisiteur', $user->id)->where('mois', $leMois)->get();

        // Variables de retour
        $numMois = substr($moisPost, 0, 2);
        $numAnnee = substr($moisPost, 3, 8);

        $libEtat = DB::table('etat')->select('libelle')->where('id', $fiche[0]->idetat)->get()[0]->libelle;
        $dateModif = $fiche[0]->datemodif;
        $lesFraisForfait = DB::table('lignefraisforfait')->join('fraisforfait', 'fraisforfait.id', '=', 'lignefraisforfait.idfraisforfait')->where('idvisiteur', $user->id)->where('mois', $leMois)->orderBy('lignefraisforfait.mois', 'desc')->get();
        $lesFraisHorsForfait = DB::table('lignefraishorsforfait')->where('idvisiteur', $user->id)->where('mois', $leMois)->get();
        return View('v_afficherFicheFrais', compact('numMois', 'numAnnee', 'libEtat', 'dateModif', 'moisPost', 'afficheMois','lesFraisHorsForfait','lesFraisForfait'));
    }

    public function export(){
        $user = Auth::user();
        $total =0;
        $leMois=$_SESSION['mois'];
        $numMois = substr($leMois, 0, 2);
        $numAnnee = substr($leMois, 3, 8);
        $leMois= substr($leMois, 3, 8) . substr($leMois, 0, 2);
        $lesFraisForfait = DB::table('lignefraisforfait')->join('fraisforfait', 'fraisforfait.id', '=', 'lignefraisforfait.idfraisforfait')->where('idvisiteur', $user->id)->where('mois', $leMois)->orderBy('lignefraisforfait.mois', 'desc')->get();
        $lesFraisHorsForfait = DB::table('lignefraishorsforfait')->where('idvisiteur', $user->id)->where('mois', $leMois)->get();
        foreach ($lesFraisForfait as $unFraisForfait){
            $total=$total+$unFraisForfait->montant*$unFraisForfait->quantite ;
        }
        foreach ($lesFraisHorsForfait as $unFraisHorsForfait){
            $total=$total+$unFraisHorsForfait->montant;
        }
        $pdf = App::make('dompdf.wrapper');

        $pdf->loadHTML(View('pdf', compact('user','numMois','numAnnee', 'libEtat', 'afficheMois','lesFraisHorsForfait','lesFraisForfait','total'))->render());

        //return View('pdf');
        return $pdf->stream();
    }


}
