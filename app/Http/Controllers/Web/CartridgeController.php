<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\CartridgeFormRequest;
use App\Models\Brand;
use App\Models\Cartridge;
use App\Models\Printer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartridgeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'menu' => 'cartridge',
        ];
        return view('app.cartridge.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::select(['id', 'description'])->get();
        $printers = Printer::select(['id', 'description'])->get();
        $colors = ['Black', 'Yellow', 'Blue', 'Magenta'];
        $data = [
            'menu'     => 'cartridge',
            'brands'   => $brands,
            'printers' => $printers,
            'colors'   => $colors,
        ];
        return view('app.cartridge.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CartridgeFormRequest $req)
    {
        $data = $req->validated();
        $cartridge = new Cartridge();
        $cartridge->user_id = Auth::user()->id;
        $cartridge->printer_id = $data['printer'];
        $cartridge->brand_id = $data['brand'];
        $cartridge->model = $data['model'];
        $cartridge->description = $data['description'];
        $cartridge->color = $data['color'];
        $cartridge->status = 'Active';
        if ($cartridge->save()) {
            return redirect()->route('app.cartridge.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Cartridge $cartridge)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cartridge $cartridge)
    {
        if ($cartridge->id == 1) {
            return redirect()->route('app.cartridge.index');
        }
        $brands = Brand::select(['id', 'description'])->get();
        $printers = Printer::select(['id', 'description'])->get();
        $colors = ['Black', 'Yellow', 'Blue', 'Magenta'];
        $data = [
            'menu'      => 'cartridge',
            'brands'    => $brands,
            'printers'  => $printers,
            'colors'    => $colors,
            'cartridge' => $cartridge,
        ];
        return view('app.cartridge.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CartridgeFormRequest $req, Cartridge $cartridge)
    {
        if ($cartridge->id == 1) {
            return redirect()->route('app.cartridge.index');
        }
        $data = $req->validated();
        $cartridge->printer_id = $data['printer'] ?? $cartridge->printer_id;
        $cartridge->brand_id = $data['brand'] ?? $cartridge->brand_id;
        $cartridge->model = $data['model'] ?? $cartridge->model;
        $cartridge->description = $data['description'] ?? $cartridge->description;
        $cartridge->color = $data['color'] ?? $cartridge->color;
        if ($cartridge->save()) {
            return redirect()->route('app.cartridge.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cartridge $cartridge)
    {
        if ($cartridge->id == 1) {
            return Response()->json(['success' => false], Response::HTTP_BAD_REQUEST);
        }
        try {
            DB::beginTransaction();
            $cartridge->status = 'Inactive';
            $cartridge->save();
            $cartridge->delete();
            DB::commit();
            $data = ['success' => true, 'cartridge' => $cartridge];
            return Response()->json($data, Response::HTTP_OK);
        } catch (\exception $ex) {
            DB::rollBack();
            $data = ['success' => false];
            return Response()->json($data, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function datatable()
    {
        $cartridge = Cartridge::with('user')->with('printer')->with('brand')->where('cartridges.id', '>', 1)->get();
        return datatables($cartridge)->toJson();
    }
}
