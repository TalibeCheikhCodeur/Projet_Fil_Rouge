<?php

namespace App\Http\Controllers;

use App\Models\Etidiant;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreEtidiantRequest;
use App\Http\Requests\UpdateEtidiantRequest;
use App\Models\AnneeScolaire;
use App\Models\Classe;

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
        $etudiants = [
            "nom" => $request->nom,
            "prenom" => $request->prenom,
            "date_naiss" => $request->date_naiss,
            "lieu_naiss" => $request->lieu_naiss,
            "telephone" => $request->telephone,
            "adresse" => $request->nom,
        ];

        DB::beginTransaction();
        $insertEtud = Etidiant::create($etudiants);

        $classe = $request->classe;
        $annee_scolaire = $request->annee_scolaire;

        $classe_id = Classe::where('libelle', $classe)->first();
        $annee_scolaire_id = AnneeScolaire::where('libelle', $annee_scolaire);

        $inscrits = [
            "classe_id" => $classe_id,
            "annee_scolaire_id" => $annee_scolaire_id,
            "etidiant_id" => $insertEtud->id
        ];

        
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
