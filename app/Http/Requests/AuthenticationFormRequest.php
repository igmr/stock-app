<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Closure;
use Illuminate\Support\Facades\Auth;

class AuthenticationFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => [
                'required', 'email', 'max:120',
                function (string $attribute, mixed $value, Closure $fail) {
                    $user = \App\Models\User::where('email', 'like', $value)->first();
                    if (!isset($user)) {
                        $fail("{$attribute} is invalid.");
                    }
                }
            ],
            'password' => [
                'required', 'string', 'max:255',
                \Illuminate\Validation\Rules\Password::min(8),
                function (string $attribute, mixed $value, Closure $fail) {
                    if(Str::of($this->email)->trim()->isEmpty())
                    {
                        return;
                    }
                    $user = \App\Models\User::where('email', 'like', $this->email)->first();
                    if (isset($user)) {
                        $dbPassword = $user->password;
                        if (!\Illuminate\Support\Facades\Hash::check($value, $dbPassword)) {
                            $fail("{$attribute} is invalid.");
                        }
                    }
                }
            ]
        ];
    }
}
