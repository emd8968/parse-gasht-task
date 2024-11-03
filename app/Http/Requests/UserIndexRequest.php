<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserIndexRequest extends FormRequest
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
            'sort' => [
                'string',
                'in:country,currency',
            ],
            'dir' => [
                'string',
                'in:asc,desc',
            ],
            'country' => [
                'string',
            ],
            'currency' => [
                'string'
            ]
        ];
    }
}
