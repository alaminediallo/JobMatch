<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:150'],
            'diplome' => ['nullable', 'file', 'mimes:pdf', 'max:2048'], // Nouveau champ pour le PDF
            'institution' => ['required', 'max:100'],
            'date_debut' => ['required', 'date'],
            'date_fin' => ['required', 'date', 'after_or_equal:date_debut'],
            'description' => ['nullable', 'max:400'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
