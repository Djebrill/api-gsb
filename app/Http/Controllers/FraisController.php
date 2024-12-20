<?php

namespace App\Http\Controllers;

use App\dao\FraisService;
use App\Exceptions\MonException;
use App\Models\Frai;
use Doctrine\DBAL\Query\QueryException;
use Exception;
use Illuminate\Http\Request;

class FraisController extends Controller
{

    public function detail($idFrais)
    {
        try {

            $FraisService = new FraisService();
            $monfrais = $FraisService->getEtatFrais($idFrais);

            return response()->json($monfrais);

        } catch (Exception $e) {

        }
    }

        public function ajout(Request $request)
        {
            try {
                $Frais = new Frai();
                $Frais->id_visiteur = $request->json('id_visiteur');
                $Frais->id_etat = 2;
                $Frais->anneemois = $request->json('anneemois');
                $Frais->nbjustificatifs = $request->json('nbjustificatifs');
                $Frais->datemodification = now();
                $FraisService = new FraisService();
                $FraisService->save($Frais);
                return response()->json(['message : ' => 'Insertion réalisée', 'id_frais' => $Frais->id_frais]);
            } catch (QueryException $e) {
                throw new MonException ($e->getMessage());
            }
        }

            public function modif(Request $request){
                try{
                    $Frais = new Frai();
                    $FraisService = new FraisService();
                    $Frais->id_frais = $request->json('id_frais');
                    $Frais->montantvalide = $request->json('montantvalide');
                    $Frais->id_visiteur = $request->json('id_visiteur');
                    $Frais->id_etat = 2;
                    $Frais->anneemois = $request->json('anneemois');
                    $Frais->nbjustificatifs = $request->json('nbjustificatifs');
                    $Frais->datemodification = now();
                    $FraisService->FraisModif($Frais);
                    return response()->json(['message : ' => 'Modification réalisée', 'id_frais' => $Frais->id_frais]);
                } catch (QueryException $e) {
                    throw new MonException ($e->getMessage());
                }


        }

    public function suppr(Request $request){
        try{
            $Frais = new Frai();
            $FraisService = new FraisService();
            $id_frais = $request->json('id_frais');
            $FraisService->FraisSuppr($Frais);
            return response()->json(['message : ' => 'Suppression réalisée', 'id_frais' => $id_frais]);
        } catch (QueryException $e) {
            throw new MonException ($e->getMessage());
        }
    }

    public function ListeFraisVisiteur($id_visiteur){
        try{
            $FraisService = new FraisService();
            $liste = $FraisService->getListeFrais($id_visiteur);
            return response()->json($liste);
        } catch (QueryException $e) {
            throw new MonException ($e->getMessage());
        }
    }


}
