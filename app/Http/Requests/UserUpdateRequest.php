<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'name' => [
                'string',
                'max:255',
            ],
            'email' => [
                'email:rfc',
            ],
            'password' => [
                'string',
                'min:5',
            ],
            'currency_id' => [
                'nullable',
                'exists:currencies,id',
            ],
            'country_id' => [
                'nullable',
                'exists:countries,id',
            ]
        ];
    }
}
