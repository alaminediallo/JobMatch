<?php

namespace App\Http\Requests;

use App\Enums\Niveau;
use Illuminate\Foundation\Http\FormRequest;

class LangueRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'niveau' => ['required', 'string', 'in:'.implode(',', Niveau::getValues())], // Validation du niveau
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
