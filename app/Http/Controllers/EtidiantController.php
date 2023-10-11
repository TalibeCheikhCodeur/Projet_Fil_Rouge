<?php

namespace App\Http\Controllers;

use App\Models\Etidiant;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreEtidiantRequest;
use App\Http\Requests\UpdateEtidiantRequest;
use App\Models\AnneeScolaire;
use App\Models\Classe;
use App\Models\Inscription;

class EtidiantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEtidiantRequest $request)
    {
        $idAnnee = AnneeScolaire::where('etat', 'en cours')->first()->id;
        $etudiants = $request->all();
        $etudiant = $etudiants['tab'];
        $etudiantsExist = Etidiant::all()->toArray();
        DB::beginTransaction();
        foreach ($etudiant as $et) {
            $apprenant = Etidiant::where('telephone', $et['telephone'])->first();
            if ($apprenant == null) {

                $newApprenant = Etidiant::create([
                    "nom" => $et['nom'],
                    "prenom" => $et['prenom'],
                    "date_de_naiss" => $et['date_de_naiss'],
                    "lieu_de_naiss" => $et['lieu_de_naiss'],
                    "adresse" => $et['adresse'],
                    "telephone" => $et['telephone'],
                    "nouveau" => $et['nouveau']
                ]);
                $idClasse = Classe::where('libelle', $et['classe'])->first()->id;
                Inscription::create([
                    "classe_id" => $idClasse,
                    "etidiant_id" => $newApprenant->id,
                    "annee_scolaire_id" => $idAnnee
                ]);
            } elseif ($apprenant != null) {

                $idClasse = Classe::where('libelle', $et['classe'])->first()->id;
                Inscription::create([
                    "classe_id" => $idClasse,
                    "etidiant_id" => $apprenant->id,
                    "annee_scolaire_id" => $idAnnee
                ]);
            }
            DB::commit();
        }
        return response(['message' => 'incription réussi']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Etidiant $etidiant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Etidiant $etidiant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEtidiantRequest $request, Etidiant $etidiant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Etidiant $etidiant)
    {
        //
    }
}
