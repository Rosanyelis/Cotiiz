<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        return redirect()->back()->with('success', 'Producto aprobado con exito');
    }

    public function reject(Request $request)
    {
        $product = Product::find($request->id);
        $product->status = 'Rechazado';
        $product->save();
        return redirect()->back()->with('success', 'Producto rechazado con exito');
    }
}
