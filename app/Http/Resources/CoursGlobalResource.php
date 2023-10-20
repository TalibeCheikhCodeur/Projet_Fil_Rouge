<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CoursGlobalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=>$this->id,
            "module" => $this->module->libelle,
            "professeur" => $this->professeur->nomComplet,
            "semestre" => $this->semestre->libelle,
            "etat" => $this->etat,
            "heures"=> CoursGlobalClasseResource::collection($this->coursGlobalClasse),
            // "heures" => $this->whenPivotLoaded("cours_global_classes",function (){
            //     return $this->cours_global_classes->nombre_heures;
            // })
            
        ];
    }
}
