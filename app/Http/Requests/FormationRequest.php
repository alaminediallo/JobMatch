<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'diplome' => ['required'],
            'date_debut' => ['required', 'date'],
            'date_fin' => ['required', 'date', 'date_format:d-m-Y', 'after_or_equal:date_debut'],
            'institution' => ['required'],
            'description' => ['nullable', 'max:400'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
