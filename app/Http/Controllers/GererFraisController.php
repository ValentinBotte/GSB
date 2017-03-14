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
        // variable test
        $moisAnnee = $annee.$mois;
        //$moisAnnee = $annee.$mois;
        $dateModif = date('Y-m-d');
        $user = Auth::user();
        $lesFraisForfait = DB::table('lignefraisforfait')->join('fraisforfait', 'fraisforfait.id', '=', 'lignefraisforfait.idfraisforfait')->where('idvisiteur', $user->id)->where('mois', $moisAnnee)->orderBy('lignefraisforfait.mois', 'desc')->get();
        $result = count($lesFraisForfait);
        // SI IL N'Y A PAS DE VALEUR POUR CE MOIS
        if($result == 0){
            DB::table('fichefrais')->insert(
                ['idvisiteur' => $user->id, 'mois' => $moisAnnee,  'nbjustificatifs' => 0, 'montantvalide' => 0, 'datemodif' => $dateModif, 'idetat' => 'CR' ]
            );
            $lesId = DB::table('fraisforfait')->select('id')->get();
            foreach ($lesId as $id){
                DB::table('lignefraisforfait')->insert(
                    ['idvisiteur' => $user->id, 'mois' => $moisAnnee,  'idfraisforfait' => $id->id, 'quantite' => 0]
                );
            }
        }
        $lesFraisHorsForfait = DB::table('lignefraishorsforfait')->where('idvisiteur', $user->id)->where('mois', $moisAnnee)->get();
        return View('v_listeFrais', compact('mois','annee','lesFraisForfait','lesFraisHorsForfait'));
    }

    public function ajoutFraisForfait(){
        $mois = date("m");
        $annee = date("Y");
        // variable test
        $moisAnnee = '200101';
        //$moisAnnee = $annee.$mois;
        $user = Auth::user();
        $dateFrais = Input::get('dateFrais');
        $libelle = Input::get('libelle');
        $montant = Input::get('montant');
        DB::table('lignefraishorsforfait')->insert(
            ['idvisiteur' => $user->id, 'mois' => $moisAnnee,  'libelle' => $libelle, 'date' => $dateFrais, 'montant' => $montant]
        );
        return $this->afficherRf();
    }
}
