<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Mail\NotifyStatusCatalogo;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;

class AdminProductController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::with('rfcsupplier', 'user')->get();
            return DataTables::of($data)
                ->addColumn('actions', function ($data) {
                    return view('admin.products.partials.actions', ['data' => $data]);
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('admin.products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Product::with('rfcsupplier', 'user')->find($id);
        return view('admin.products.show', compact('data'));
    }

    public function aprove(Request $request)
    {
        $product = Product::find($request->id);
        $product->status = 'Aprobado';
        $product->save();

        $data = Product::find($request->id);
        # enviar el correo de notificacion
        Mail::to($data->user->email)->send(new NotifyStatusCatalogo($data));

        Notification::create([
            'rfc_suppliers_id' => $data->rfc_suppliers_id,
            'type' => 'Proveedor',
            'user_id' => $data->user->id,
            'title' => 'Producto Aprobada',
            'message' => 'El producto ' . $data->name . ' ha sido aprobada.'
        ]);

        return redirect()->back()->with('success', 'Producto aprobado con exito');
    }

    public function reject(Request $request)
    {
        $product = Product::find($request->id);
        $product->status = 'Rechazado';
        $product->save();

        $data = Product::find($request->id);
        # enviar el correo de notificacion
        Mail::to($data->user->email)->send(new NotifyStatusCatalogo($data));

        Notification::create([
            'rfc_suppliers_id' => $data->rfc_suppliers_id,
            'type' => 'Proveedor',
            'user_id' => $data->user->id,
            'title' => 'Producto Rechazado',
            'message' => 'El producto ' . $data->name . ' ha sido rechazada.'
        ]);

        return redirect()->back()->with('success', 'Producto rechazado con exito');
    }
}
