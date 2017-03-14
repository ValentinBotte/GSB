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
            foreach ($lesIdForfait as $idForfait){
                DB::table('lignefraisforfait')->insert(
                    ['idvisiteur' => $user->id, 'mois' => $anneeMois,  'idfraisforfait' => $idForfait->id, 'quantite' => 0]
                );
            }
        }
        $lesFraisHorsForfait = DB::table('lignefraishorsforfait')->where('idvisiteur', $user->id)->where('mois', $anneeMois)->get();
        return View('v_listeFrais', compact('mois','annee','lesFraisForfait','lesFraisHorsForfait'));
    }

    public function ajoutFraisForfait(){
        $anneeMois = $this->annee.$this->mois;
        $user = Auth::user();
        $dateFrais = Input::get('dateFrais');
        $libelle = Input::get('libelle');
        $montant = Input::get('montant');
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

    public function supprimerFiche($id){
        $data['id'] = $id;
        DB::table('lignefraishorsforfait')->where('id', '=', $data)->delete();
        url('afficher_renseigner_frais');
        return $this->afficherRf();
    }
}
