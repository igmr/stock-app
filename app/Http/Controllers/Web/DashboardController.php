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
        ];
        return view('app.dashboard', compact('data'));
    }

    public function listStockMin()
    {
        $stockMin = DB::table('stock')
            ->join('cartridges', 'cartridges.id', '=', 'stock.cartridge_id')
            ->join('printers', 'printers.id', '=', 'cartridges.printer_id')
            ->join('brands', 'brands.id', '=', 'printers.brand_id')
            ->select([
                'brands.description AS brand', 'printers.description AS printer',
                'cartridges.model AS cartridge_model', 'cartridges.description AS cartridge', 'cartridges.color', DB::raw('SUM(stock._quantity) AS quantity')
            ])
            ->groupBy(['brands.description', 'printers.description', 'cartridges.model', 'cartridges.description', 'cartridges.color'])
            ->havingRaw('SUM(stock._quantity) < ?', [2])
            ->orderByDesc('stock.created_at')
            ->get();
        return datatables($stockMin)->toJson();

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

    public function listStock()
    {
        $query = DB::select('SELECT brands.description AS brand, printers.description AS printer, cartridges.description AS cartridge,
             cartridges.color,if(ISNULL(stock), 0, stock) AS stock
        FROM brands
        LEFT JOIN printers ON printers.brand_id = brands.id
        LEFT JOIN cartridges ON cartridges.printer_id = printers.id
        LEFT JOIN (SELECT stock.cartridge_id, SUM(stock._quantity) AS stock
            FROM stock
            WHERE 1=1
            AND stock.deleted_at IS NULL
            GROUP BY  stock.cartridge_id) AS stock ON stock.cartridge_id = cartridges.id
        WHERE 1=1
            AND printers.id > 1
            AND brands.deleted_at IS NULL
            AND printers.deleted_at IS NULL
            AND cartridges.deleted_at IS NULL
        ORDER BY printers.description ASC');
        return datatables($query)->toJson();
    }

    public function history()
    {
        $data = [
            'menu'         => 'report.history',
        ];
        return view('app.report.history', compact('data'));
    }

    public function listHistory()
    {
        $report = Stock::with('user')->with('cartridge', function ($query) {
            return $query->with('printer');
        })->get();
        return datatables($report)->toJson();
    }
}
