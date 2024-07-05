<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'menu'    => 'dashboard',
            'topTeen' => $this->topTeen(),
        ];
        return view('app.dashboard', compact('data'));
    }

    public function topTeen()
    {
        $query = DB::select('SELECT stock.id, stock.created_at, stock._quantity,
                cartridges.description AS cartridge,
                printers.description AS printer, type
            FROM stock
            LEFT JOIN cartridges ON stock.cartridge_id = cartridges.id
            LEFT JOIN printers ON cartridges.printer_id = printers.id
            LEFT JOIN brands ON printers.brand_id = brands.id
            WHERE 1=1
                AND stock.deleted_at IS NULL
            ORDER BY stock.id DESC
            LIMIT 10;');
        return $query;
    }
}
