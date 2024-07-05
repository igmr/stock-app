<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StockFormRequest;
use App\Models\Cartridge;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'menu' => 'stock',
        ];
        return view('app.stock.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cartridge = Cartridge::select(['id', 'description'])->get();
        $types = [
            ['id' => 1, 'description' => 'Entrada al almacén'],
            ['id' => 0, 'description' => 'Salida del almacén'],
        ];
        $data = [
            'menu'      => 'stock',
            'cartridge' => $cartridge,
            'types'     => $types,
        ];
        return view('app.stock.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StockFormRequest $req)
    {
        $data = $req->validated();
        $stock = new Stock();
        $stock->user_id = Auth::user()->id;
        $stock->cartridge_id = $data['cartridge'];
        $stock->quantity = $data['quantity'];
        $stock->_quantity = $data['type'] == 0 ? $data['quantity'] * -1 : $data['quantity'];
        $stock->type = $data['type'];
        $stock->observation = $data['observation'];
        $stock->cost = $data['cost'];
        $stock->status = 'Active';
        if ($stock->save()) {
            return redirect()->route('app.stock.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Stock $stock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stock $stock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stock $stock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stock $stock)
    {
        try {
            DB::beginTransaction();
            $stock->status = 'Inactive';
            $stock->save();
            $stock->delete();
            DB::commit();
            $data = ['success' => true, 'stock' => $stock];
            return Response()->json($data, Response::HTTP_OK);
        } catch (\exception $ex) {
            DB::rollBack();
            $data = ['success' => false];
            return Response()->json($data, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function datatable()
    {
        $stock = Stock::with('user')->with('cartridge', function ($query) {
            $query->with('printer');
        })->orderBy('id', 'DESC')->get();
        return datatables($stock)->toJson();
    }
}
