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
                Rule::unique('')],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
