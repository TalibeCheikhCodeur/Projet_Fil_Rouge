<?php

namespace App\Http\Controllers;

use App\Models\Cours_global;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreCours_globalRequest;
use App\Http\Requests\UpdateCours_globalRequest;
use App\Models\CoursGlobalClasse;
use Symfony\Component\HttpFoundation\Response;

class CoursGlobalController extends Controller
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
    public function store(StoreCours_globalRequest $request)
    {
        $coursGlobal = [
            'module_id' => $request->module_id,
            'semestre_id' => $request->semestre_id,
            'professeur_id' => $request->professeur_id,
            'etat' => $request->etat
        ];

        DB::beginTransaction();
        $insertCours = Cours_global::create($coursGlobal);
        $classes= $request->classes;
        
        foreach ($classes as $classe) {
            $coursGlobalClasse = [
                'cours_global_id' => $insertCours->id,
                'classe_id' => $classe['classe'],
                'nombre_heures' => $request->nombre_heures,
                'nombre_heures_effectues' => 0
            ];
            $insertCoursClasse = CoursGlobalClasse::create($coursGlobalClasse);
        }
        DB::commit();

        return Response()->json(['Ajout reussi']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Cours_global $cours_global)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cours_global $cours_global)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCours_globalRequest $request, Cours_global $cours_global)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cours_global $cours_global)
    {
        //
    }
}
