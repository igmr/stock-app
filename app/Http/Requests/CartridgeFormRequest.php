<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CartridgeFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'printer'     => ['required', 'string', 'gt:0'],
                    'brand'       => ['required', 'string', 'gt:0'],
                    'description' => ['required', 'string', 'max:255'],
                    'model'       => ['required', 'string', 'max:65', "unique:cartridges,model"],
                    'color'       => ['required', 'string', 'max:32'],
                ];
            case 'PUT':
                return [
                    'printer'     => ['nullable', 'integer', 'gt:0'],
                    'brand'       => ['nullable', 'string', 'gt:0'],
                    'description' => ['nullable', 'string', 'max:255'],
                    'model'       => [
                        'nullable', 'string', 'max:65',
                        Rule::unique("cartridges", "model")->ignore($this->segment(3), "id"),
                    ],
                    'color'       => ['nullable', 'string', 'max:32'],
                ];
        }
    }
}
