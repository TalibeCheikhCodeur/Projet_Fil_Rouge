<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEtidiantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "nom" => $this->nom,
            "prenom" => $this->prenom,
            "date_naiss" => $this->date_naiss,
            "lieu_naiss" => $this->lieu_naiss,
            "telephone" => $this->telephone,
            "adresse" => $this->nom,
        ];
    }
}
