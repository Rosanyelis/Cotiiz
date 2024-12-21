<?php

namespace App\Http\Controllers\Admin;

use App\Models\Notification;
use App\Models\Professional;
use Illuminate\Http\Request;
use App\Mail\NotifyStatusCatalogo;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;

class AdminProfessionalController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Professional::join('occupations', 'professionals.occupation_id', '=', 'occupations.id')
                ->join('specialties', 'professionals.specialty_id', '=', 'specialties.id')
                ->join('rfc_suppliers', 'professionals.rfc_suppliers_id', '=', 'rfc_suppliers.id')
                ->join('users', 'professionals.user_id', '=', 'users.id')
                ->select(
                    DB::raw('CONCAT(professionals.firstname, " ", professionals.second_name, " ", professionals.lastname, " ", professionals.second_lastname) as fullname'),
                    'occupations.name as occupation',
                    'specialties.name as specialty',
                    'professionals.id',
                    'professionals.status',
                    'professionals.file_photo as photo',
                    'rfc_suppliers.name as rfc_supplier',
                    'users.name as user'
                )
                ->groupBy('professionals.id', 'professionals.status', 'professionals.file_photo', 'rfc_suppliers.name', 'users.name');
            return DataTables::of($data)
                ->addColumn('actions', function ($data) {
                    return view('admin.professionals.partials.actions', ['data' => $data]);
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('admin.professionals.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Professional::with('rfcsupplier', 'user')->find($id);
        return view('admin.professionals.show', compact('data'));
    }


    public function aprove(Request $request)
    {
        $product = Professional::find($request->id);
        $product->status = 'Aprobado';
        $product->save();

        $data = Professional::find($request->id);
        # enviar el correo de notificacion
        Mail::to($data->user->email)->send(new NotifyStatusCatalogo($data));

        Notification::create([
            'rfc_suppliers_id' => $data->rfc_suppliers_id,
            'type' => 'Proveedor',
            'user_id' => $data->user->id,
            'title' => 'Profesional aprobado',
            'message' => 'El profesional ' . $data->firstname . ' ' . $data->second_name . ' ' . $data->lastname . ' ' . $data->second_lastname . ' ha sido aprobada.'
        ]);

        return redirect()->back()->with('success', 'Profesional aprobado con exito');
    }

    public function reject(Request $request)
    {
        $product = Professional::find($request->id);
        $product->status = 'Rechazado';
        $product->save();

        $data = Professional::find($request->id);
        # enviar el correo de notificacion
        Mail::to($data->user->email)->send(new NotifyStatusCatalogo($data));

        Notification::create([
            'rfc_suppliers_id' => $data->rfc_suppliers_id,
            'type' => 'Proveedor',
            'user_id' => $data->user->id,
            'title' => 'Profesional rechazado',
            'message' => 'El profesional ' . $data->firstname . ' ' . $data->second_name . ' ' . $data->lastname . ' ' . $data->second_lastname . ' ha sido rechazado.'
        ]);

        return redirect()->back()->with('success', 'Profesional rechazado con exito');
    }
}
