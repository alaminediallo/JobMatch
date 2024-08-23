<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExperienceRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'titre_post' => ['required', 'string', 'max:100'],
            'entreprise' => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string', 'max:400'],
            'date_debut' => ['required', 'date'],
            'date_fin' => ['nullable', 'date', 'after:date_debut'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
