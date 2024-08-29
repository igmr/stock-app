<?php

namespace App\Http\Requests;

use Closure;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StockFormRequest extends FormRequest
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
                    'cartridge'   => [
                        'required', 'integer',
                        function (string $attribute, mixed $value, Closure $fail) {
                            if ($value <= 1) {
                                $fail("{$attribute} is required.");
                            }
                            return;
                        }
                    ],
                    'quantity'    => [
                        'required', 'numeric', 'gt:0',
                        function (string $attribute, mixed $value, Closure $fail) {
                            try {
                                if ($this->cartridge <= 1) {
                                    $fail("{$attribute} is invalid (1).");
                                    return;
                                }
                                // type 1 => Entrada al almacén - No hacer nada
                                // type 0 => Salida al almacén  - revisar existencia
                                if ($this->type == 0) {
                                    $_cartridge = \App\Models\Cartridge::where('deleted_at', null)
                                        ->find($this->cartridge);
                                    if (isset($_cartridge)) {
                                        $_stock = DB::table('stock')
                                            ->groupBy('cartridge_id')
                                            ->where('cartridge_id', $this->cartridge)
                                            ->select([DB::raw('SUM(_quantity) AS stock')])
                                            ->get();
                                        $calcule = $_stock[0]->stock + ($value * -1);
                                        if ($calcule < 0) {
                                            $fail("{$attribute} is invalid (2).");
                                        }
                                        return;
                                    }
                                    $fail("{$attribute} error processor (400).");
                                }
                            } catch (\Exception $ex) {
                                $fail("{$attribute} error processor (500)." . $ex->getMessage());
                            }
                        }
                    ],
                    'date_at'     => ['required', 'string',],
                    'type'        => ['required', 'numeric',],
                    'cost'        => ['nullable', 'decimal:0,6', 'gte:0'],
                    'observation' => ['nullable', 'string', 'max:512'],
                ];
        }
    }
}
