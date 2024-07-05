<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class BrandFormRequest extends FormRequest
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
                    "description"  => [
                        "required", "string",'max:64', "unique:brands,description",
                    ],
                ];
            case 'PUT':
                return [
                    "description"  => [
                        "nullable", "string", "max:64",
                        Rule::unique("brands", "description")->ignore($this->segment(3), "id"),
                    ],
                ];
        }
    }
}
