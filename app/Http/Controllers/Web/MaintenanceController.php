<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\CancelFormRequest;
use App\Http\Requests\DeliveryFormRequest;
use App\Http\Requests\FollowFormRequest;
use App\Http\Requests\MaintenanceFormRequest;
use App\Models\Follow;
use App\Models\Maintenance;
use App\Models\Printer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'menu' => 'maintenance',
        ];
        return view('app.maintenance.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $printers = Printer::all();
        $data = [
            'menu'     => 'maintenance',
            'printers' => $printers,
        ];
        return view('app.maintenance.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MaintenanceFormRequest $req)
    {
        $data = $req->validated();
        $maintenance = new Maintenance();
        $maintenance->user_id = Auth::user()->id;
        $maintenance->printer_id = $data['printer'];
        $maintenance->internal = $data['internal'];
        $maintenance->date_init = $data['date_init'];
        $maintenance->user_name = $data['user_name'];
        $maintenance->cost = $data['cost'];
        $maintenance->observation_init = $data['observation'];
        $maintenance->status = 'Active';
        if ($maintenance->save()) {
            return redirect()->route('app.maintenance.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Maintenance $maintenance)
    {
        $maintenance = Maintenance::with('follows')->with('archives')
            ->with('printer')->with('user')
            ->where('id', $maintenance->id)->get();
        $data = [
            'menu'        => 'maintenance',
            'maintenance' => $maintenance,
        ];
        return view('app.maintenance.info', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Maintenance $maintenance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Maintenance $maintenance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Maintenance $maintenance)
    {
        //
    }

    public function datatable()
    {
        $maintenance = Maintenance::with('user')->with('printer')->get();
        return datatables($maintenance)->toJson();
    }

    public function delivery(Maintenance $maintenance)
    {
        $data = [
            'menu'        => 'maintenance',
            'maintenance' => $maintenance,
        ];
        return view('app.maintenance.delivery', compact('data'));
    }

    public function delivery_action(DeliveryFormRequest $req, Maintenance $maintenance)
    {
        $data = $req->validated();
        $maintenance->date_finish = Carbon::now();
        $maintenance->observation_finish = $data['observation'];
        $maintenance->status = 'Delivery';
        if ($maintenance->save()) {
            return redirect()->route('app.maintenance.index');
        }
    }

    public function follow(Maintenance $maintenance)
    {
        $data = [
            'menu'        => 'maintenance',
            'maintenance' => $maintenance,
        ];
        return view('app.maintenance.follow', compact('data'));
    }

    public function follow_action(FollowFormRequest $req, Maintenance $maintenance)
    {
        $data = $req->validated();
        $maintenance_id = $maintenance->id;
        $follow = new Follow();
        $follow->user_id = Auth::user()->id;
        $follow->maintenance_id = $maintenance_id;
        $follow->observation = $data['observation'];
        $follow->status = 'Active';
        if ($follow->save()) {
            return redirect()->route('app.maintenance.index');
        }
    }

    public function cancel(Maintenance $maintenance)
    {
        $data = [
            'menu'        => 'maintenance',
            'maintenance' => $maintenance,
        ];
        return view('app.maintenance.cancel', compact('data'));
    }

    public function cancel_action(CancelFormRequest $req, Maintenance $maintenance)
    {
        $data = $req->validated();
        $maintenance->date_cancel = Carbon::now();
        $maintenance->observation_cancel = $data['observation'];
        $maintenance->status = "Cancel";
        if ($maintenance->save()) {
            return redirect()->route('app.maintenance.index');
        }
    }
}
