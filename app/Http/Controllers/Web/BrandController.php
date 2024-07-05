<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandFormRequest;
use App\Models\Brand;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'menu' => 'brand',
        ];
        return view('app.brand.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'menu' => 'brand',
        ];
        return view('app.brand.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandFormRequest $req)
    {
        $data = $req->validated();
        $brand = new Brand();
        $brand->description = $data['description'] ?? '';
        $brand->user_id = Auth::user()->id;
        $brand->status = 'active';
        if ($brand->save()) {
            return redirect()->route('app.brand.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        $data = [
            'menu'  => 'brand',
            'brand' => $brand,
        ];
        return view('app.brand.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BrandFormRequest $req, Brand $brand)
    {
        $data = $req->validated();
        $brand->description = $data['description'] ?? $brand->description;
        if ($brand->save()) {
            return redirect()->route('app.brand.index');
        }
    }

    public function destroy(Brand $brand)
    {
        try {
            DB::beginTransaction();
            $brand->status = 'Inactive';
            $brand->save();
            $brand->delete();
            DB::commit();
            $data = ['success' => true, 'brand' => $brand];
            return Response()->json($data, Response::HTTP_OK);
        } catch (\exception $ex) {
            DB::rollBack();
            $data = ['success' => false];
            return Response()->json($data, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function datatable()
    {
        $brands = Brand::with('user')->get();
        return datatables($brands)->toJson();
    }
    public function select2()
    {
        $brands = Brand::select(['id', 'description'])->get();
        return $brands;
    }
}
