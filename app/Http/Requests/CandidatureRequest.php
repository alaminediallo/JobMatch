<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CandidatureRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'lettre_motivation' => ['required', 'file', 'mimes:pdf', 'max:1024'],
            'cv' => ['required', 'file', 'mimes:pdf', 'max:1024'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
