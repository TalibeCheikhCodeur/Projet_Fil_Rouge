<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSessionCourRequest;
use App\Http\Requests\UpdateSessionCourRequest;
use App\Http\Resources\CoursGlobalClasseResource;
use App\Http\Resources\SessionResource;
use App\Models\Classe;
use App\Models\Cours_global;
use App\Models\CoursGlobalClasse;
use App\Models\Module;
use App\Models\Salle;
use App\Models\SessionCour;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\ElseIf_;

class SessionCourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $session = new SessionCour();
        return SessionResource::collection($session->all());
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
        $ids = $request->cours_global_classe_id;
        $idClasseCours = CoursGlobalClasse::where('id', $ids[0])->first();
        $idCour = $idClasseCours->cours_global_id;
        $idmodule = Cours_global::where('id', $idCour)->first()->module_id;
        $libelle = Module::where('id', $idmodule)->first()->libelle;
        $nbrHeure = $idClasseCours->nombre_heures;
        $nHeure = $this->conversionToSecondes($nbrHeure.":00:00");
        $duree = strtotime($request->heure_fin) - strtotime($request->heure_debut);
        $dureeRestant = ($nHeure - $duree)/3600;
        // return $dureeRestant;

        foreach ($ids as $id) {
            $session = [
                "module" => $libelle,
                "heure_debut" => $request->heure_debut,
                "heure_fin" => $request->heure_fin,
                "duree" => $duree/3600,
                "etat" => $request->etat,
                "type_cours" => $request->type_cours,
                "cours_global_classe_id" => $id,
                "professeur_id" => $request->professeur_id,
                "salle_id" => $request->salle_id,
                "date" => $request->date
            ];

            if (
                $this->isProfDispo($request) && $request->type_cours == 'presentiel' && $this->isSalleDispo($request)
                || $this->isProfDispo($request) && $request->type_cours == 'en ligne'
            ) {

                $insertSession = SessionCour::create($session);
                CoursGlobalClasse::where('id', $idClasseCours->id)->update(['nombre_heures' => $dureeRestant]);

                return response(["message" => "session enregistrer avec succes"]);
            } elseif (!($this->isSalleDispo($request))) {
                return response(["message" => "la salle ne peut contenir cette effectifs"]);
            } elseif (!($this->isProfDispo($request))) {
                return response(["message" => "Désolé ce professeur n'est pas disponoble"]);
            } elseif (!($this->isSalleDispo($request)) && !($this->isProfDispo($request))) {
                return response(["message" => "professeur non disponible et salle trop petite"]);
            }
        }
    }

    public function conversionToSecondes($duree)
    {
        list($heures, $minutes, $secondes) = explode(':', $duree);
        return $heures * 3600 + $minutes * 60 + $secondes;
    }

    public function isProfDispo(StoreSessionCourRequest $request)
    {
        $idCoursClasseSessions = $request->cours_global_classe_id;
        $date = $request->date;
        $hdr = $request->heure_debut;
        $hfr = $request->heure_fin;
        $idCourClasseSession = $idCoursClasseSessions[0];
        $idClasseCours = CoursGlobalClasse::where('id', $idCourClasseSession)->first();
        $idCour = $idClasseCours->cours_global_id;
        $idProf = Cours_global::where('id', $idCour)->first()->professeur_id;
        $session = SessionCour::where(['professeur_id' => $idProf, "date" => $date])->first();
        if ($session == null) {
            return true;
        } elseif ($session != null) {
            $hdb = $session->heure_debut;
            $hfb = $session->heure_fin;
            if (
                (strtotime($hdr) >= strtotime($hdb) && strtotime($hdr) <= strtotime($hfb))
                || (strtotime($hfr) >= strtotime($hdb) && strtotime($hfr) <= strtotime($hfb))
                || (strtotime($hdr) >= strtotime($hfr) || (strtotime($hdr) <= strtotime($hdb)
                    && strtotime($hfr) >= strtotime($hfb)))
            ) {
                return false;
            }
        }
        return true;
    }

    public function isSalleDispo(StoreSessionCourRequest $request)
    {
        $effectif = 0;
        $idCoursClasseSessions = $request->cours_global_classe_id;
        foreach ($idCoursClasseSessions as $id) {
            $idClasse = CoursGlobalClasse::where('id', $id)->first()->classe_id;
            $effectif += Classe::where('id', $idClasse)->first()->effectifs;
        }
        $nombrePlace = Salle::where('id', $request->salle_id)->first()->taille;
        if ($nombrePlace >= $effectif) {
            return true;
        }
        return false;
    }

    public function getCoursClasse(Request $request)
    {
        $idCours = $request->cour_id;
        $coursClasse = CoursGlobalClasse::where('cours_global_id', $idCours)->get();
        return CoursGlobalClasseResource::collection($coursClasse);
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
