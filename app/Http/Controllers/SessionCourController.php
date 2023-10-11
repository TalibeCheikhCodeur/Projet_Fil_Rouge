<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSessionCourRequest;
use App\Http\Requests\UpdateSessionCourRequest;
use App\Models\Cours_global;
use App\Models\CoursGlobalClasse;
use App\Models\SessionCour;
use Illuminate\Contracts\Session\Session;

class SessionCourController extends Controller
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
    public function store(StoreSessionCourRequest $request)
    {
        $session = [
            "heure_debut" => $request->heure_debut,
            "heure_fin" => $request->heure_fin,
            "duree" => $request->duree,
            "etat" => $request->etat,
            "type_cours" => $request->type_cours,
            "cours_global_classe_id" => $request->cours_global_classe_id,
            "salle_id" => $request->salle_id,
            "date" => $request->date
        ];

        if ($session['type_cour'] == 'en ligne') {
            $insertSession = SessionCour::create($session);
        }
    }

    public function isProfDispo(StoreSessionCourRequest $request)
    {
        $idCoursClasseSessions = $request->cours_global_classe_id;
        $date = $request->date;
        $hd =$request->heure_debut;
        $hf=$request->heure_fin;
        $idCourClasseSession = $idCoursClasseSessions[0];
        $idClasseCours = CoursGlobalClasse::where('id', $idCourClasseSession)->first();
        $idCour = $idClasseCours->cours_global_id;
        $idProf = Cours_global::where('id', $idCour)->first()->professeur_id;
        $session = SessionCour::where(['professeur_id' => $idProf,"date" => $date])->first();
        // if ($session == null) {
        //     return true;
        // } elseif ($session != null) {
        //     if (strtotime($hd)) {
        //         # code...
        //     }
        // }
    }

    /**
     * Display the specified resource.
     */
    public function show(SessionCour $sessionCour)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SessionCour $sessionCour)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSessionCourRequest $request, SessionCour $sessionCour)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SessionCour $sessionCour)
    {
        //
    }
}
