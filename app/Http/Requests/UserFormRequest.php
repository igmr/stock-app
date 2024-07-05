<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'name'        => ['required', 'string', 'max:120'],
                    'email'       => ['required', 'email', 'max:120', 'unique:users,email'],
                    'password'    => [
                        'required', 'string', 'max:255', 'confirmed',
                        Password::min(8),
                    ],
                ];
            case 'PUT':
                return [
                    'name'        => ['required', 'string', 'max:120'],
                    'email'       => [
                        'required', 'email', 'max:120',
                        Rule::unique('users', 'email')->ignore($this->segment(3), 'id'),
                    ],
                ];
        }
    }
}
