<?php
namespace App\dao;
use App\Exceptions\MonException;
use App\Http\Controllers\Controller;

use App\Models\Frai;
use App\Models\Etat;
use Doctrine\DBAL\Query\QueryException;
use Exception;
use Illuminate\Http\Request;

class FraisService extends Controller
{
    public function getEtatFrais($idFrais) {
        try {
            $frais = Frai::query()->select()->join('etat', 'etat.id_etat', '=', 'frais.id_etat')->where('id_frais', '=', $idFrais)->first();

            return $frais;

        } catch (QueryException $e) {
            throw new MonException ($e->getMessage());
        }

    }


    public function save(Frai $frais)
    {
        try {
            $frais->save();
        } catch (QueryException $e) {
            throw new MonException ($e->getMessage());
        }
    }

    public function FraisModif($frais)
    {
        try {
            $frais->update();
        } catch (QueryException $e) {
            throw new MonException ($e->getMessage());
        }
    }

    public function FraisSuppr($id_frais)
    {
        try {
            Frai::destroy($id_frais);
        } catch (QueryException $e) {
            throw new MonException ($e->getMessage());
        }
    }

    public function getListeFrais($id_visiteur) {
        try {
            $frais = Frai::query()
                ->select()
                ->join('etat', 'etat.id_etat', '=', 'frais.id_etat')
                ->where('id_visiteur', '=', $id_visiteur)
                ->get();
            return $frais;

        } catch (QueryException $e) {
            throw new MonException ($e->getMessage());
        }

    }


}
