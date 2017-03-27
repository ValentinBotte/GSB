<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class ComptableFraisController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->mois = date('m');
        $this->annee = date('Y');
    }

    public function valideFrais(){

        $lesVisiteurs = DB::table('visiteur')->where('comptable', '=', 0)->orderBy('name')->get();

        return View('v_afficherValideFrais', compact('lesVisiteurs'));
    }

    public function getMois(){
        $afficheMois=[];

        $lesMois = DB::table('fichefrais')->select('mois')->where('idvisiteur', '=', Input::get('idVisiteur'))->orderBy('mois', 'desc')->get();
        foreach($lesMois as $unMois){
            if(substr($unMois->mois, 0, 4) >= date('Y') - 1) {
                $tempMois = substr($unMois->mois, 4, 6) . '/' . substr($unMois->mois, 0, 4);
                $afficheMois[] = $tempMois;
            }
        }

        return $afficheMois;
    }

    private $id = "";
    private function setVisiteur($id){
        $this->id = $id;
    }
    private function getVisiteur(){
        return $this->id;
    }
    public function afficherFiche(){

        $mois = Input::get('mois');
        $visiteur = Input::get('visiteur');
        $this->setVisiteur(Input::get('visiteur'));
        $visiteur2 = DB::table('visiteur')->where('id', '=', Input::get('visiteur'))->get();
        $lesMois = DB::table('fichefrais')->select('mois')->where('idvisiteur', '=', $visiteur)->orderBy('mois', 'desc')->get();
        foreach($lesMois as $unMois){
            if(substr($unMois->mois, 0, 4) >= date('Y') - 1){
                $tempMois = substr($unMois->mois, 4, 6) . '/' . substr($unMois->mois, 0, 4);
                $afficheMois[] = $tempMois;
            }
        }
        $lesVisiteurs = DB::table('visiteur')->where('comptable', '=', 0)->orderBy('name')->get();

        $numMois = substr($mois, 0, 2);
        $numAnnee = substr($mois, 3, 8);
        $anneeMois = substr($mois, 3, 8) . substr($mois, 0, 2);
        $fiche = DB::table('fichefrais')->where('idvisiteur', '=', $visiteur)->where('mois', '=', $anneeMois)->get();
        $etat = DB::table('etat')->select('libelle')->where('id', $fiche[0]->idetat)->get()[0]->libelle;
        $dateModif = $fiche[0]->datemodif;
        $lesFraisForfait = DB::table('lignefraisforfait')->join('fraisforfait', 'fraisforfait.id', '=', 'lignefraisforfait.idfraisforfait')->where('idvisiteur', '=', $visiteur)->where('mois', '=', $anneeMois)->orderBy('lignefraisforfait.mois', 'desc')->get();
        $lesFraisHorsForfait = DB::table('lignefraishorsforfait')->where('idvisiteur', '=', $visiteur)->where('mois', '=', $anneeMois)->get();
        return View('v_afficherValideFrais', compact('visiteur', 'visiteur2','mois','numMois','numAnnee','etat','dateModif','lesFraisForfait','lesFraisHorsForfait','lesVisiteurs','afficheMois','anneeMois'));
    }

    public function modifierFraisForfait($id){
        $anneeMois = $this->annee.$this->mois;
        $user = $this->getVisiteur();
        dd($user);
        $fraisEtp = Input::get('lesFraisETP');
        $fraisKm = Input::get('lesFraisKM');
        $fraisNui = Input::get('lesFraisNUI');
        $fraisRep = Input::get('lesFraisREP');
        if($fraisEtp!=null and $fraisKm!=null and $fraisNui!=null and $fraisRep!=null){
            DB::table('lignefraisforfait')->where('idvisiteur', $user)->where('mois', $anneeMois)->where('idfraisforfait', 'NUI')->update(['quantite' => $fraisNui]);
            DB::table('lignefraisforfait')->where('idvisiteur', $user)->where('mois', $anneeMois)->where('idfraisforfait', 'ETP')->update(['quantite' => $fraisEtp]);
            DB::table('lignefraisforfait')->where('idvisiteur', $user)->where('mois', $anneeMois)->where('idfraisforfait', 'REP')->update(['quantite' => $fraisRep]);
            DB::table('lignefraisforfait')->where('idvisiteur', $user)->where('mois', $anneeMois)->where('idfraisforfait', 'KM')->update(['quantite' => $fraisKm]);
        }

        return $this->afficherFiche();
    }



    public function suiviFiche(){
        return View('v_afficherSuiviFrais');
    }
}
