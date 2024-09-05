<?php

namespace App\Http\Requests;

use App\Enums\TypeOffre;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OffreRequest extends FormRequest
{
    public function rules(): array
    {
        $dateDebutRules = $this->isMethod('post')
            ? ['required', 'date', 'after_or_equal:today', 'date_format:Y-m-d']
            // Lors de la création, la date de début doit être égal ou après aujourd'hui
            : ['required', 'date', 'date_format:Y-m-d'];

        return [
            'title' => ['required', 'string', 'min:5', 'max:255'],
            'salaire_proposer' => ['required', 'numeric', 'min:0', 'min_digits:5', "max_digits:10"],
            'type_offre' => ['required', Rule::in(TypeOffre::getValues())],
            'date_debut' => $dateDebutRules,
            'date_fin' => ['required', 'date', 'after:date_debut', 'date_format:Y-m-d'],
            'description' => ['nullable', 'string', 'min:10', 'max:800'],
            'category_id' => ['required', Rule::exists('categories', 'id')],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
