<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class AdminServiceController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Service::with('rfcsupplier', 'user')->get();
            return DataTables::of($data)
                ->addColumn('actions', function ($data) {
                    return view('admin.services.partials.actions', ['data' => $data]);
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('admin.services.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Service::with('rfcsupplier', 'user')->find($id);
        return view('admin.services.show', compact('data'));
    }

    public function aprove(Request $request)
    {
        $service = Service::find($request->id);
        $service->status = 'Aprobado';
        $service->save();
        return redirect()->back()->with('success', 'Servicio aprobado con exito');
    }

    public function reject(Request $request)
    {
        $service = Service::find($request->id);
        $service->status = 'Rechazado';
        $service->save();
        return redirect()->back()->with('success', 'Servicio rechazado con exito');
    }
}
