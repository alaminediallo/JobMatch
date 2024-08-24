<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
        $passwordRules = $this->isMethod('post') // Lors de la création, le mot de passe est requis
            ? ['required', 'string', 'min:5']
            : ['nullable', 'string', 'min:5']; // Lors de la mise à jour, le mot de passe est nullable

        return [
            'name' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'tel' => ['nullable', 'string', 'max:20'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($this->route('user'))],
            'password' => $passwordRules,
            'password_confirmation' => ['nullable', 'same:password'],
            'adresse' => ['nullable', 'string', 'max:255'],
            'role_id' => ['required', Rule::exists('roles', 'id')],
            'nom_entreprise' => ['required', 'string', 'min:4', 'max:100'],
            'type_entreprise_id' => ['required', Rule::exists('type_entreprises', 'id')],
            'description_entreprise' => ['nullable', 'string', 'max:500'],
        ];
    }
}
