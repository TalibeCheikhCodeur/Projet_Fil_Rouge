<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CoursGlobalClasseResource extends JsonResource
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
            "classe"=>$this->classes->libelle,
            "nombre_heures" => $this->nombre_heures,
            "nombre_heures_effectues" => $this->nombre_heures_effectues
        ];
    }
}
