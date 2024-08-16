<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoleRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'min:5',
                Rule::unique('roles')->ignore($this->route('role')),
            ],
            'user_ids' => 'nullable',
            'user_ids.*' => 'exists:users,id',
            'permissions' => ['required', 'min:1'],
            'permissions.*' => 'exists:permissions,id',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'required' => 'Le :attribute est obligatoire.',
            'string' => 'Le :attribute doit être une chaîne de caractères.',
            'nom.unique' => 'Ce nom de rôle est déjà utilisé.',
            'nom.max' => 'Le :attribute ne doit pas dépasser :max caractères.',
            'user_ids.*.exists' => 'Un ou plusieurs utilisateurs sélectionnés sont invalides.',
            'permissions.required' => 'Veuillez sélectionner au moins une permission.',
            'permissions.*.exists' => 'Une ou plusieurs permissions sélectionnées sont invalides.',
            'permissions.min' => 'Veuillez sélectionner au moins une permission.',
        ];
    }
}
