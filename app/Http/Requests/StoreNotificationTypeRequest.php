<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNotificationTypeRequest extends FormRequest
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
            'type' => 'required|string|max:50',
            'description' => 'nullable|string|max:255',
            'is_active' => 'nullable|boolean',
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
            'type.required' => 'The notification type is required.',
            'type.string' => 'The notification type must be a string.',
            'type.max' => 'The notification type must not exceed 50 characters.',
            'description.string' => 'The description must be a string.',
            'description.max' => 'The description must not exceed 255 characters.',
            'created_by.required' => 'The created by field is required.',
            'created_by.string' => 'The created by field must be a string.',
            'created_by.max' => 'The created by field must not exceed 50 characters.',
        ];
    }
}
