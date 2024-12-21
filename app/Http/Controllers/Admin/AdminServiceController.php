<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Mail\NotifyStatusCatalogo;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
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

        $data = Service::find($request->id);
        # enviar el correo de notificacion
        Mail::to($data->user->email)->send(new NotifyStatusCatalogo($data));

        Notification::create([
            'rfc_suppliers_id' => $data->rfc_suppliers_id,
            'type' => 'Proveedor',
            'user_id' => $data->user->id,
            'title' => 'Servicio aprobado',
            'message' => 'El servicio ' . $data->name . ' ha sido aprobada.'
        ]);

        return redirect()->back()->with('success', 'Servicio aprobado con exito');
    }

    public function reject(Request $request)
    {
        $service = Service::find($request->id);
        $service->status = 'Rechazado';
        $service->save();

        $data = Service::find($request->id);
        # enviar el correo de notificacion
        Mail::to($data->user->email)->send(new NotifyStatusCatalogo($data));

        Notification::create([
            'rfc_suppliers_id' => $data->rfc_suppliers_id,
            'type' => 'Proveedor',
            'user_id' => $data->user->id,
            'title' => 'Servicio rechazado',
            'message' => 'El servicio ' . $data->name . ' ha sido rechazada.'
        ]);


        return redirect()->back()->with('success', 'Servicio rechazado con exito');
    }
}
