<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePriorityRequest extends FormRequest
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
            'level' => 'required|string|max:200',
            'description' => 'nullable|string|max:255',
            'created_by' => 'required|string|max:50',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'level.required' => 'The level is required',
            'level.string' => 'The level must be a string',
            'level.max' => 'The level must not be greater than 200 characters',
            'description.string' => 'The description must be a string',
            'description.max' => 'The description must not be greater than 255 characters',
            'created_by.required' => 'The created by is required',
            'created_by.string' => 'The created by must be a string',
            'created_by.max' => 'The created by must not be greater than 50 characters',
        ];
    }
}
