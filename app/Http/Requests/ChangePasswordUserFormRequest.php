<?php

namespace App\Http\Requests;

use App\Models\User;
use Closure;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ChangePasswordUserFormRequest extends FormRequest
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
        return [
            'current_password' => [
                'required', 'max:254', Password::min(8),
                function (string $attribute, mixed $value, Closure $fail) {
                    $user_id = Auth::user()->id;
                    $user = User::findOrFail($user_id);
                    $passwordHash = $user->password;
                    if (Hash::check($value, $passwordHash)) {
                        return;
                    }
                    $fail("{$attribute} is invalid (400).");
                }
            ],
            'password'         => ['required', 'max:254', 'confirmed', Password::min(8),],
        ];
    }
}
