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
        $this->mois = date('m');
        $this->annee = date('Y');
    }

    /*
     *  CONTROLLER AFFICHAGE RENSEIGNER FICHE DE FRAIS
     */

    public function afficherRf(){
        $mois = $this->mois;
        $annee = $this->annee;
        $anneeMois = $annee.$mois;
        $dateModif = date('Y-m-d');
        $user = Auth::user();
        $lesFraisForfait = DB::table('lignefraisforfait')->join('fraisforfait', 'fraisforfait.id', '=', 'lignefraisforfait.idfraisforfait')->where('idvisiteur', $user->id)->where('mois', $anneeMois)->orderBy('lignefraisforfait.mois', 'desc')->get();
        $result = count($lesFraisForfait);
        // SI IL N'Y A PAS DE VALEUR POUR CE MOIS
        if($result == 0){
            DB::table('fichefrais')->insert(
                ['idvisiteur' => $user->id, 'mois' => $anneeMois,  'nbjustificatifs' => 0, 'montantvalide' => 0, 'datemodif' => $dateModif, 'idetat' => 'CR' ]
            );
            $lesIdForfait = DB::table('fraisforfait')->select('id')->get();
            $typeVehicule = DB::table('vehicule')->select('idtype')->where('idvisiteur', $user->id)->where('etat', 1)->get();
            foreach ($lesIdForfait as $idForfait){
                if($idForfait->id == 'ETP' || $idForfait->id == 'NUI' || $idForfait->id == 'REP'){
                    DB::table('lignefraisforfait')->insert(
                        ['idvisiteur' => $user->id, 'mois' => $anneeMois,  'idfraisforfait' => $idForfait->id, 'quantite' => 0]
                    );
                }
            }
            foreach ($typeVehicule as $idVehicule){
                    DB::table('lignefraisforfait')->insert(
                        ['idvisiteur' => $user->id, 'mois' => $anneeMois,  'idfraisforfait' => $idVehicule->idtype, 'quantite' => 0]
                    );
            }
            $lesFraisForfait = DB::table('lignefraisforfait')->join('fraisforfait', 'fraisforfait.id', '=', 'lignefraisforfait.idfraisforfait')->where('idvisiteur', $user->id)->where('mois', $anneeMois)->orderBy('lignefraisforfait.mois', 'desc')->get();

        }
        $lesFraisHorsForfait = DB::table('lignefraishorsforfait')->where('idvisiteur', '=', $user->id)->where('mois', '=', $anneeMois)->get();
        return View('v_listeFrais', compact('mois','annee','lesFraisForfait','lesFraisHorsForfait'));
    }

    public function ajoutFraisForfait(){
        $anneeMois = $this->annee.$this->mois;
        $user = Auth::user();
        $typeVehicule = DB::table('vehicule')->select('idtype')->where('idvisiteur', $user->id)->where('etat', 1)->get();
        $libelleKm = 'lesFrais'.$typeVehicule[0]->idtype;
        $dateFrais = Input::get('dateFrais');
        $libelle = Input::get('libelle');
        $montant = Input::get('montant');
        $fraisEtp = Input::get('lesFraisETP');
        $fraisKm = Input::get($libelleKm);
        $fraisNui = Input::get('lesFraisNUI');
        $fraisRep = Input::get('lesFraisREP');
        if($fraisEtp!=null and $fraisKm!=null and $fraisNui!=null and $fraisRep!=null){
            DB::table('lignefraisforfait')->where('idvisiteur', $user->id)->where('mois', $anneeMois)->where('idfraisforfait', 'NUI')->update(['quantite' => $fraisNui]);
            DB::table('lignefraisforfait')->where('idvisiteur', $user->id)->where('mois', $anneeMois)->where('idfraisforfait', 'ETP')->update(['quantite' => $fraisEtp]);
            DB::table('lignefraisforfait')->where('idvisiteur', $user->id)->where('mois', $anneeMois)->where('idfraisforfait', 'REP')->update(['quantite' => $fraisRep]);
            DB::table('lignefraisforfait')->where('idvisiteur', $user->id)->where('mois', $anneeMois)->where('idfraisforfait', $typeVehicule[0]->idtype)->update(['quantite' => $fraisKm]);
        }

        if($dateFrais!=null and $libelle!=null and $montant!=null){
            list($jour, $mois, $annee ) = explode('/', $dateFrais);
            if(checkdate($mois,$jour,$annee)){
                $formatDate = $annee . "-" . $mois . "-" . $jour;
                DB::table('lignefraishorsforfait')->insert(
                    ['idvisiteur' => $user->id, 'mois' => $anneeMois,  'libelle' => $libelle, 'date' => $formatDate, 'montant' => $montant]
                );
            }
        }

        return $this->afficherRf();
    }
    // FONCTION QUI AJOUTE REFUSE SUR LE LIBELLE
//    public function supprimerFiche($id){
//        $data['id'] = $id;
//        $libelleObjet = DB::table('lignefraishorsforfait')->select('libelle')->where('id', '=', $data)->get();
//        $libelle = $libelleObjet[0]->libelle;
//        $verif = preg_match("#REFUSE#i","'.$libelle'");
//        if($verif == 0){
//            DB::table('lignefraishorsforfait')->where('id', '=', $data)->update(['libelle' => '[REFUSE]'.$libelle]);
//        }
//        url('afficher_renseigner_frais');
//        return $this->afficherRf();
//    }

    public function supprimerFiche($id){
        $data['id'] = $id;
        DB::table('lignefraishorsforfait')->where('id', '=', $data)->delete();
        url('afficher_renseigner_frais');
        return $this->afficherRf();
    }
}
