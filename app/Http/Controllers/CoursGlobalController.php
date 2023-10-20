<?php

namespace App\Http\Controllers;

use App\Models\Cours_global;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreCours_globalRequest;
use App\Http\Requests\UpdateCours_globalRequest;
use App\Http\Resources\CoursGlobalClasseResource;
use App\Http\Resources\CoursGlobalResource;
use App\Models\CoursGlobalClasse;
use Symfony\Component\HttpFoundation\Response;

class CoursGlobalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cours = Cours_global::with('coursGlobalClasse')->get();
        $coursClasse = CoursGlobalClasse::all();
        return CoursGlobalResource::collection($cours);
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
        if (!$this->isInserable($request)) {
            $coursGlobal = [
                'module_id' => $request->module_id,
                'semestre_id' => $request->semestre_id,
                'professeur_id' => $request->professeur_id,
                'etat' => $request->etat
            ];

            DB::beginTransaction();
            $insertCours = Cours_global::create($coursGlobal);
            $classes = $request->classes;

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

            return Response()->json(['message'=>'Ajout reussi']);
        }
        return Response()->json(['message'=>'Ce cours existe déja']);
    }

    public function isInserable(StoreCours_globalRequest $request)
    {
        $module = $request->module_id;
        $prof = $request->professeur_id;
        $courExist = Cours_global::all()->toArray();
        foreach ($courExist as $key) {
            if ($key['module_id'] == $module && $key['professeur_id'] == $prof) {
                return true;
            }
        }
        return false;
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
