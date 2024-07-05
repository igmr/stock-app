<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PrinterFormRequest extends FormRequest
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
                    'brand'       => ['required', 'string', 'gt:0'],
                    'serial'      => ['required', 'string', 'max:65', 'unique:printers,serial'],
                    'model'       => ['nullable', 'string', 'max:65'],
                    'description' => ['nullable', 'string', 'max:65'],
                    'cost'        => ['nullable', 'decimal:0,6', 'gte:0'],
                    'location'    => ['required', 'string', 'max:255'],
                ];
                case 'PUT':
                    return [
                    'brand'       => ['nullable', 'string', 'gt:0'],
                    'serial'      => [
                        'nullable', 'string', 'max:65',
                        Rule::unique('printers', 'serial')->ignore($this->segment(3), 'id'),
                    ],
                    'model'       => ['nullable', 'string', 'max:65'],
                    'description' => ['nullable', 'string', 'max:65'],
                    'cost'        => ['nullable', 'decimal:0,6', 'gte:0'],
                    'location'    => ['nullable', 'string', 'max:255'],
                ];
        }
    }
}
