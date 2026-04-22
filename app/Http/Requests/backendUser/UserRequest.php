<?php

namespace App\Http\Requests\backendUser;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Changed from false to true to allow authorization
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $userId = $this->route('id'); // Get the ID from route for update

        return [
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('backend_users', 'username')->ignore($userId)
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('backend_users', 'email')->ignore($userId)
            ],
            'password' => [
                $this->isMethod('POST') ? 'required' : 'nullable',
                'min:6'
            ],
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'is_active' => 'nullable|boolean',
            'send_verification_email' => 'nullable|boolean',
        ];
    }

    /**
     * Get custom messages for validation errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'username.required' => 'The username is required.',
            'username.unique' => 'This username is already taken.',
            'email.required' => 'The email address is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email address is already registered.',
            'password.required' => 'The password is required.',
            'password.min' => 'The password must be at least 6 characters.',
            'first_name.required' => 'The first name is required.',
            'last_name.required' => 'The last name is required.',
        ];
    }
}