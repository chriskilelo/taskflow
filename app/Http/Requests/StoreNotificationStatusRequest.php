<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNotificationStatusRequest extends FormRequest
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
            'status' => 'required|string|max:50',
            'description' => 'nullable|string|max:255',
            'created_by' => 'required|string|max:50',
            'is_active' => 'nullable',     
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
            'status.required' => 'The status field is required.',
            'status.string' => 'The status field must be a string.',
            'status.max' => 'The status field must not exceed 50 characters.',
            'description.string' => 'The description field must be a string.',
            'description.max' => 'The description field must not exceed 255 characters.',
            'created_by.required' => 'The created by field is required.',
            'created_by.string' => 'The created by field must be a string.',
            'created_by.max' => 'The created by field must not exceed 50 characters.',
        ];
    }
}
