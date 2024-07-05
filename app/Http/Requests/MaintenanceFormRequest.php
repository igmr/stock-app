<?php

namespace App\Http\Requests;

use Closure;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class MaintenanceFormRequest extends FormRequest
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
                    'printer'     => [
                        'required', 'integer', function (string $attribute, mixed $value, Closure $fail) {
                            if ($value <= 1) {
                                $fail("{$attribute} is required.");
                            }
                            return;
                        }
                    ],
                    'internal'    => ['required', 'boolean'],
                    'user_name'   => ['required', 'string', 'max:65'],
                    'date_init'   => ['required', 'string'],
                    'cost'        => ['nullable', 'gte:0'],
                    'observation' => ['required', 'string', 'max:512'],
                ];
            case 'PUT':
                return [
                    'printer'     => ['nullable', 'integer', function (string $attribute, mixed $value, Closure $fail) {
                        if ($value <= 1) {
                            $fail("{$attribute} is required.");
                        }
                        return;
                    }],
                    'internal'    => ['nullable', 'boolean'],
                    'user_name'   => ['nullable', 'string', 'max:65'],
                    'date_init'   => ['nullable', 'string'],
                    'cost'        => ['nullable', 'gte:0'],
                    'observation' => ['nullable', 'string', 'max:512'],
                    'delivery'    => ['nullable', 'string', 'max:512'],
                    'cancel'      => ['required', 'string', 'max:512'],
                ];
        }
    }
}
