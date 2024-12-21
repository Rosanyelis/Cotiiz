<?php

namespace App\Http\Controllers\Supplier;

use App\Models\Product;
use App\Models\Service;
use App\Models\Professional;
use Illuminate\Http\Request;
use App\Models\SuppliersChat;
use App\Models\SupplierRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SupplierDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $totalsolicitudproveedor = SupplierRequest::where('rfc_suppliers_id', Auth::user()->rfcsuppliers()->first()->id)->count();
        $totalmensajes = SuppliersChat::where('rfc_suppliers_id', Auth::user()->rfcsuppliers()->first()->id)->count();
        $totalproductos = Product::where('rfc_suppliers_id', Auth::user()->rfcsuppliers()->first()->id)->where('status', 'Pendiente')->count();
        $totalservicios = Service::where('rfc_suppliers_id', Auth::user()->rfcsuppliers()->first()->id)->where('status', 'Pendiente')->count();
        $totalprofesionales = Professional::where('rfc_suppliers_id', Auth::user()->rfcsuppliers()->first()->id)->where('status', 'Pendiente')->count();

        return response()->json([
            'totalsolicitudproveedor' => $totalsolicitudproveedor,
            'totalmensajes' => $totalmensajes,
            'totalproductos' => $totalproductos,
            'totalservicios' => $totalservicios,
            'totalprofesionales' => $totalprofesionales,
        ]);

    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
