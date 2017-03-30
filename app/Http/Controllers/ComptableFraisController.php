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
        $lesFraisHorsForfait = [];
        $listeHorsForfait = DB::table('lignefraishorsforfait')->where('idvisiteur', $visiteur)->where('mois', $anneeMois)->get();
        foreach ( $listeHorsForfait as $item){
            $libelle = $item->libelle;
            $verif = preg_match("#REFUSE#i","'.$libelle'");
            if($verif == 0){
                $lesFraisHorsForfait[] = $item;
            }
        }        return View('v_afficherValideFrais', compact('visiteur', 'visiteur2','mois','numMois','numAnnee','etat','dateModif','lesFraisForfait','lesFraisHorsForfait','lesVisiteurs','afficheMois','anneeMois'));
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
        $libelleObjet = DB::table('lignefraishorsforfait')->select('libelle')->where('id', '=', $data)->get();
        $libelle = $libelleObjet[0]->libelle;
        $verif = preg_match("#REFUSE#i","'.$libelle'");
        if($verif == 0){
            DB::table('lignefraishorsforfait')->where('id', '=', $data)->update(['libelle' => '[REFUSE]'.$libelle]);
        }
        return $this->utilitaire();
    }

    public function reporterFraisForfait($id){
        $data['id'] = $id;
        $dateModif = date('Y-m-d');
        $anneeMoisBase = $_SESSION['mois'];
        $annee = substr($anneeMoisBase,0,4);
        $mois = substr($anneeMoisBase,4,5);
        $mois = $mois+1;
        if($mois>12){
            $mois = $mois - 12;
            $annee = $annee+1;
        }
        if($mois<10){
            $mois = '0'.$mois;
        }
        $anneeMois = $annee.$mois;
        $visiteur = DB::table('lignefraishorsforfait')->where('id', '=', $data)->where('mois', '=', $anneeMoisBase)->get();
        $lesFraisForfait = DB::table('lignefraisforfait')->join('fraisforfait', 'fraisforfait.id', '=', 'lignefraisforfait.idfraisforfait')->where('idvisiteur', $visiteur[0]->idvisiteur)->where('mois', $anneeMois)->orderBy('lignefraisforfait.mois', 'desc')->get();
        $result = count($lesFraisForfait);
        // SI IL N'Y A PAS DE VALEUR POUR CE MOIS
        if($result == 0){
            DB::table('fichefrais')->insert(
                ['idvisiteur' => $visiteur[0]->idvisiteur, 'mois' => $anneeMois,  'nbjustificatifs' => 0, 'montantvalide' => 0, 'datemodif' => $dateModif, 'idetat' => 'CR' ]
            );
            $lesIdForfait = DB::table('fraisforfait')->select('id')->get();
            foreach ($lesIdForfait as $idForfait){
                DB::table('lignefraisforfait')->insert(
                    ['idvisiteur' => $visiteur[0]->idvisiteur, 'mois' => $anneeMois,  'idfraisforfait' => $idForfait->id, 'quantite' => 0]
                );
            }
            DB::table('lignefraishorsforfait')->where('id', '=', $data)->delete();
            DB::table('lignefraishorsforfait')->insert(
                ['id' => $visiteur[0]->id, 'idvisiteur' => $visiteur[0]->idvisiteur,  'mois' => $anneeMois, 'libelle' => $visiteur[0]->libelle, 'date' => $dateModif, 'montant' => $visiteur[0]->montant ]
            );
        }
        else{
            DB::table('lignefraishorsforfait')->where('id', '=', $data)->delete();
            DB::table('lignefraishorsforfait')->insert(
                ['id' => $visiteur[0]->id, 'idvisiteur' => $visiteur[0]->idvisiteur,  'mois' => $anneeMois, 'libelle' => $visiteur[0]->libelle, 'date' => $dateModif, 'montant' => $visiteur[0]->montant ]
            );
        }
        return $this->utilitaire();
    }



    public function suiviFiche(){
        return View('v_afficherSuiviFrais');
    }
}
