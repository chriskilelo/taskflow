<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNotificationRequest extends FormRequest
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
            'user_id' => 'required|integer',
            'subject' => 'required|string',
            'message' => 'required|string',
            'type' => 'required|string|max:100',
            'status' => 'required|string|max:100',
            'created_by' => 'required|string|max:50',
            'send_attempts' => 'nullable|integer',
            'scheduled_at' => 'nullable|date',
            'sent_at' => 'nullable|date',
            'is_active' => 'nullable|boolean',
            'is_sent' => 'nullable|boolean',
            'has_error' => 'nullable|boolean',
            'failed_at' => 'nullable|date',
            'error_message' => 'nullable|string',
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
            'user_id.required' => 'User ID is required',
            'user_id.integer' => 'User ID must be an integer',
            'subject.required' => 'Subject is required',
            'subject.string' => 'Subject must be a string',
            'message.required' => 'Message is required',
            'message.string' => 'Message must be a string',
            'type.required' => 'Type is required',
            'type.string' => 'Type must be a string',
            'type.max' => 'Type must not be greater than 100 characters',
            'status.required' => 'Status is required',
            'status.string' => 'Status must be a string',
            'status.max' => 'Status must not be greater than 100 characters',
            'created_by.required' => 'Created by is required',
            'created_by.string' => 'Created by must be a string',
            'created_by.max' => 'Created by must not be greater than 50 characters',
            'send_attempts.integer' => 'Send attempts must be an integer',
            'scheduled_at.date' => 'Scheduled at must be a date',
            'sent_at.date' => 'Sent at must be a date',
            'is_active.boolean' => 'Is active must be a boolean',
            'is_sent.boolean' => 'Is sent must be a boolean',
            'has_error.boolean' => 'Has error must be a boolean',
            'failed_at.date' => 'Failed at must be a date',
            'error_message.string' => 'Error message must be a string',
        ];
    }
}
