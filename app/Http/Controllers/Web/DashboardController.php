<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Stock;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'menu'         => 'dashboard',
            'topTeen'      => $this->topTeen(),
            'listStockMin' => $this->listStockMin(),
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

    public function listStockMin()
    {
        return DB::table('stock')
            ->join('cartridges', 'cartridges.id', '=', 'stock.cartridge_id')
            ->join('printers', 'printers.id', '=', 'cartridges.printer_id')
            ->join('brands', 'brands.id', '=', 'printers.brand_id')
            ->select([
                'brands.description AS brand', 'printers.description AS printer',
                'cartridges.model', 'cartridges.description AS cartridge', DB::raw('SUM(stock._quantity) AS quantity')
            ])
            ->groupBy(['brands.description', 'printers.description', 'cartridges.model', 'cartridges.description'])
            ->havingRaw('SUM(stock._quantity) < ?', [2])
            ->orderByDesc('stock.created_at')
            ->paginate(5);

        return DB::select(
            'SELECT brands.description AS brand, printers.description AS printer,
                cartridges.model, cartridges.description AS cartridge, SUM(stock._quantity) AS quantity
            FROM stock
                INNER JOIN cartridges ON stock.cartridge_id = cartridges.id
                INNER JOIN printers ON cartridges.printer_id = printers.id
                INNER JOIN brands ON printers.brand_id = brands.id
            WHERE 1
            GROUP BY brands.description, printers.description, cartridges.model, cartridges.description
            HAVING SUM(stock._quantity) < 2
            ORDER BY stock.created_at DESC;'
        );
    }
}
