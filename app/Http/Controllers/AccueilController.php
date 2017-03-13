<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        return View('v_listeMois');
    }


}
