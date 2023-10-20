<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SessionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "module" =>$this->module,
            "heure_debut" => $this->heure_debut,
            "heure_fin" => $this->heure_fin,
            "duree" => $this-> duree,
            "etat" =>$this->etat,
            "type_cours" => $this->type_cours,
            "salle_id" => $this->salle->nom,
            "date" => $this->date
        ];
    }
}
