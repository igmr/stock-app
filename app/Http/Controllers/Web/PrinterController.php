<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\PrinterFormRequest;
use App\Models\Brand;
use App\Models\Printer;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PrinterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'menu' => 'printer',
        ];
        return view('app.printer.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::select(['id', 'description'])->get();
        $data = [
            'menu'   => 'printer',
            'brands' => $brands,
        ];
        return view('app.printer.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PrinterFormRequest $req)
    {
        $data = $req->validated();
        $printer = new Printer();
        $printer->user_id = Auth::user()->id;
        $printer->brand_id = $data['brand'];
        $printer->serial = $data['serial'];
        $printer->model = $data['model'];
        $printer->description = $data['description'];
        $printer->location = $data['location'];
        $printer->cost = $data['cost'];
        $printer->status = 'Active';
        if ($printer->save()) {
            return redirect()->route('app.printer.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Printer $printer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Printer $printer)
    {
        if ($printer->id == 1) {
            return redirect()->route('app.printer.index');
        }
        $brands = Brand::select(['id', 'description'])->get();
        $data = [
            'menu'    => 'printer',
            'brands'  => $brands,
            'printer' => $printer,
        ];
        return view('app.printer.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PrinterFormRequest $req, Printer $printer)
    {
        if ($printer->id == 1) {
            return redirect()->route('app.printer.index');
        }
        $data = $req->validated();
        $printer->brand_id = $data['brand'] ?? $printer->brand_id;
        $printer->serial = $data['serial'] ?? $printer->serial;
        $printer->model = $data['model'] ?? $printer->model;
        $printer->description = $data['description'] ?? $printer->description;
        $printer->location = $data['location'] ?? $printer->location;
        $printer->cost = $data['cost'] ?? $printer->cost;
        if ($printer->save()) {
            return redirect()->route('app.printer.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Printer $printer)
    {
        try {
            if ($printer->id == 1) {
                return Response()->json(['success' => false], Response::HTTP_BAD_REQUEST);
            }
            DB::beginTransaction();
            $printer->status = 'Inactive';
            $printer->save();
            $printer->delete();
            DB::commit();
            $data = ['success' => true, 'printer' => $printer];
            return Response()->json($data, Response::HTTP_OK);
        } catch (\exception $ex) {
            DB::rollBack();
            $data = ['success' => false];
            return Response()->json($data, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function datatable()
    {
        $printer = Printer::with('user')->with('brand')->where('printers.id', '>',1)->get();
        return datatables($printer)->toJson();
    }
}
