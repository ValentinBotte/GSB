<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
session_start();
class ComptableSuiviFraisController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->mois = date('m');
        $this->annee = date('Y');
    }

    public function suiviFrais(){

        $lesVisiteurs = DB::table('visiteur')->select('id','name','prenom','email','comptable')->join('fichefrais', 'fichefrais.idvisiteur', '=', 'visiteur.id')->where('comptable', '=', 0)->where('idetat', '=', 'VA')->groupBy('id','name','prenom','email','comptable')->orderBy('name')->get();
        return View('v_afficherSuiviFrais', compact('lesVisiteurs'));
    }

    public function getMois(){
        $afficheMois=[];
        $_SESSION['visiteur'] = Input::get('idVisiteur');
        $lesMois = DB::table('fichefrais')->select('mois')->where('idvisiteur', '=', Input::get('idVisiteur'))->where('idetat', '=', 'VA')->orderBy('mois', 'desc')->get();
        foreach($lesMois as $unMois){
            if(substr($unMois->mois, 0, 4) >= date('Y') - 1) {
                $tempMois = substr($unMois->mois, 4, 6) . '/' . substr($unMois->mois, 0, 4);
                $afficheMois[] = $tempMois;
            }
        }

        return $afficheMois;
    }

    public function utilitaire(){
        // ANNEE MOIS VIDE QUAND ON CHANGE DE MOIS APRES LA PREMIERE FOIS
        $anneeMois = $_SESSION['mois'];
        $visiteur = $_SESSION['visiteur'];
        $numMois = substr($anneeMois, 4, 5);
        $numAnnee = substr($anneeMois, 0, 4);
        $mois = $numMois."/".$numAnnee;
        $visiteur2 = DB::table('visiteur')->where('id', '=', $visiteur)->get();
        $lesMois = DB::table('fichefrais')->distinct()->select('mois')->where('idetat', '=', 'VA')->orderBy('mois', 'desc')->get();
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
        $lesFraisHorsForfait = [];
        $listeHorsForfait = DB::table('lignefraishorsforfait')->where('idvisiteur', $visiteur)->where('mois', $anneeMois)->get();
        foreach ( $listeHorsForfait as $item){
            $libelle = $item->libelle;
            $verif = preg_match("#REFUSE#i","'.$libelle'");
            if($verif == 0){
                $lesFraisHorsForfait[] = $item;
            }
        }
        return View('v_afficherSuiviFrais', compact('visiteur', 'visiteur2','mois','numMois','numAnnee','etat','dateModif','lesFraisForfait','lesFraisHorsForfait','lesVisiteurs','afficheMois','anneeMois'));
    }

    public function actionElement(){
            $mois = Input::get('mois');
            $_SESSION['mois'] = substr($mois, 3, 8) . substr($mois, 0, 2);
            return $this->utilitaire();
    }

    public function validerFiche(){
        $anneeMois = $_SESSION['mois'];
        $visiteur = $_SESSION['visiteur'];
        $dateModif = date('Y-m-d');
        DB::table('fichefrais')->where('idvisiteur', $visiteur)->where('mois', $anneeMois)->update(['datemodif' => $dateModif]);
        DB::table('fichefrais')->where('idvisiteur', $visiteur)->where('mois', $anneeMois)->update(['idetat' => 'RB']);
        return redirect('');
    }


}
