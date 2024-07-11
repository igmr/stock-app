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
        $stockMin = DB::select(
            'SELECT cartridges.id, cartridges.description AS cartridge, cartridges.color, cartridges.model
                , printers.id AS printer_id,  printers.description AS printer
                , brands.id AS brand_id, brands.description AS brand
                , IFNULL(_stock.quantity, 0) AS quantity
            FROM cartridges
            INNER JOIN printers ON  printers.id = cartridges.printer_id
            INNER JOIN brands ON cartridges.brand_id = brands.id 
            LEFT JOIN _stock ON cartridges.id = _stock.cartridge_id
            WHERE 1=1
                AND cartridges.id > 1
                AND IFNULL(_stock.quantity, 0) < 2
        ');
        return datatables($stockMin)->toJson();
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
