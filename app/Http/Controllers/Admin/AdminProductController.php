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

        // Validar si el producto ya está aprobado
        if ($product->status === 'Aprobado') {
            return redirect()->back()->with('error', 'El producto ya está aprobado.');
        }

        $product->status = 'Aprobado';
        $product->save();

        // Enviar notificación por correo
        Mail::to($product->user->email)->send(new NotifyStatusCatalogo($product));

        Notification::create([
            'rfc_suppliers_id' => $product->rfc_suppliers_id,
            'type' => 'Proveedor',
            'user_id' => $product->user->id,
            'title' => 'Producto Aprobado',
            'message' => 'El producto ' . $product->name . ' ha sido aprobado.',
        ]);

        return redirect()->back()->with('success', 'Producto aprobado con éxito.');
    }


    public function reject(Request $request)
{
    $product = Product::find($request->id);

    // Validar si el producto ya está rechazado
    if ($product->status === 'Rechazado') {
        return redirect()->back()->with('error', 'El producto ya está rechazado.');
    }

    $product->status = 'Rechazado';
    $product->save();

    // Enviar notificación por correo
    Mail::to($product->user->email)->send(new NotifyStatusCatalogo($product));

    Notification::create([
        'rfc_suppliers_id' => $product->rfc_suppliers_id,
        'type' => 'Proveedor',
        'user_id' => $product->user->id,
        'title' => 'Producto Rechazado',
        'message' => 'El producto ' . $product->name . ' ha sido rechazado.',
    ]);

    return redirect()->back()->with('success', 'Producto rechazado con éxito.');
}

}
