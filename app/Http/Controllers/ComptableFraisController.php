<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
session_start();
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
    public function utilitaire(){
        $anneeMois = $_SESSION['mois'];
        $visiteur = $_SESSION['visiteur'];
        $numMois = substr($anneeMois, 4, 5);
        $numAnnee = substr($anneeMois, 0, 4);
        $mois = $numMois."/".$numAnnee;
        $visiteur2 = DB::table('visiteur')->where('id', '=', $visiteur)->get();
        $lesMois = DB::table('fichefrais')->select('mois')->where('idvisiteur', '=', $visiteur)->orderBy('mois', 'desc')->get();
        foreach($lesMois as $unMois){
            if(substr($unMois->mois, 0, 4) >= date('Y') - 1){
                $tempMois = substr($unMois->mois, 4, 6) . '/' . substr($unMois->mois, 0, 4);
                $afficheMois[] = $tempMois;
            }
        }

        $lesVisiteurs = DB::table('visiteur')->where('comptable', '=', 0)->orderBy('name')->get();
        $fiche = DB::table('fichefrais')->where('idvisiteur', '=', $visiteur)->where('mois', '=', $anneeMois)->get();
        $etat = DB::table('etat')->select('libelle')->where('id', $fiche[0]->idetat)->get()[0]->libelle;
        $dateModif = $fiche[0]->datemodif;
        $lesFraisForfait = DB::table('lignefraisforfait')->join('fraisforfait', 'fraisforfait.id', '=', 'lignefraisforfait.idfraisforfait')->where('idvisiteur', '=', $visiteur)->where('mois', '=', $anneeMois)->orderBy('lignefraisforfait.mois', 'desc')->get();
        $lesFraisHorsForfait = DB::table('lignefraishorsforfait')->where('idvisiteur', '=', $visiteur)->where('mois', '=', $anneeMois)->get();
        return View('v_afficherValideFrais', compact('visiteur', 'visiteur2','mois','numMois','numAnnee','etat','dateModif','lesFraisForfait','lesFraisHorsForfait','lesVisiteurs','afficheMois','anneeMois'));
    }
    public function afficherFiche(){
        $mois = Input::get('mois');
        $visiteur = Input::get('visiteur');
        $_SESSION['mois'] = substr($mois, 3, 8) . substr($mois, 0, 2);
        $_SESSION['visiteur'] = $visiteur;
        return $this->utilitaire();
    }

    public function modifierFraisForfait(){
        $anneeMois = $_SESSION['mois'];
        $visiteur = $_SESSION['visiteur'];
        $fraisEtp = Input::get('lesFraisETP');
        $fraisKm = Input::get('lesFraisKM');
        $fraisNui = Input::get('lesFraisNUI');
        $fraisRep = Input::get('lesFraisREP');
        if($fraisEtp!=null and $fraisKm!=null and $fraisNui!=null and $fraisRep!=null){
            DB::table('lignefraisforfait')->where('idvisiteur', $visiteur)->where('mois', $anneeMois)->where('idfraisforfait', 'NUI')->update(['quantite' => $fraisNui]);
            DB::table('lignefraisforfait')->where('idvisiteur', $visiteur)->where('mois', $anneeMois)->where('idfraisforfait', 'ETP')->update(['quantite' => $fraisEtp]);
            DB::table('lignefraisforfait')->where('idvisiteur', $visiteur)->where('mois', $anneeMois)->where('idfraisforfait', 'REP')->update(['quantite' => $fraisRep]);
            DB::table('lignefraisforfait')->where('idvisiteur', $visiteur)->where('mois', $anneeMois)->where('idfraisforfait', 'KM')->update(['quantite' => $fraisKm]);
        }
        return $this->utilitaire();
    }

    public function supprimerFraisForfait($id){
        $data['id'] = $id;
        dd($data);
        $libelleObjet = DB::table('lignefraishorsforfait')->select('libelle')->where('id', '=', $data)->get();
        $libelle = $libelleObjet[0]->libelle;
        $verif = preg_match("#REFUSE#i","'.$libelle'");
        if($verif == 0){
            DB::table('lignefraishorsforfait')->where('id', '=', $data)->update(['libelle' => '[REFUSE]'.$libelle]);
        }
        return $this->utilitaire();
       }



    public function suiviFiche(){
        return View('v_afficherSuiviFrais');
    }
}
