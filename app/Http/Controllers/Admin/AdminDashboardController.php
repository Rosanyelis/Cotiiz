<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Product;
use App\Models\Service;
use App\Models\RfcBussines;
use App\Models\RfcSupplier;
use App\Models\Professional;
use Illuminate\Http\Request;
use App\Models\SuppliersChat;
use App\Models\BussinesRequest;
use App\Models\SupplierRequest;
use App\Http\Controllers\Controller;

class AdminDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $totalempresas = RfcBussines::count();
        $totalproveedores = RfcSupplier::count();
        $totalempresasnav = RfcBussines::where('status', '0')->count();
        $totalproveedoresnav = RfcSupplier::where('status', '0')->count();
        $totalusuarios = User::role(['Empresa', 'Proveedor', 'Empresa-Prueba', 'Empresa-Operador', 'Proveedor-Operador'])->count();
        $totalsolicitudproveedor = SupplierRequest::count();
        $totalsolicitudempresa = BussinesRequest::count();
        $totalsolicitud = $totalsolicitudproveedor + $totalsolicitudempresa;
        $totalmensajes = SuppliersChat::count();
        $totalproductos = Product::count();
        $totalservicios = Service::count();
        $totalprofesionales = Professional::count();
        $totalcatalago = $totalproductos + $totalservicios + $totalprofesionales;
        $totalproductosporaprobar = Product::where('status', 'Pendiente')->count();
        $totalserviciosporaprobar = Service::where('status', 'Pendiente')->count();
        $totalprofesionalesporaprobar = Professional::where('status', 'Pendiente')->count();
        $totalusersproveedores = User::role(['Proveedor','Proveedor-Operador'])->count();
        $totaluserempresas = User::role(['Empresa', 'Empresa-Operador'])->count();
        $totaluserprueba = User::role('Empresa-Prueba')->count();


        return response()->json([
            'totalempresasnav' => $totalempresasnav,
            'totalproveedoresnav' => $totalproveedoresnav,
            'totalempresas' => $totalempresas,
            'totalproveedores' => $totalproveedores,
            'totalusuarios' => $totalusuarios,
            'totalusersproveedores' => $totalusersproveedores,
            'totaluserempresas' => $totaluserempresas,
            'totaluserprueba' => $totaluserprueba,
            'totalsolicitudproveedor' => $totalsolicitudproveedor,
            'totalsolicitudempresa' => $totalsolicitudempresa,
            'totalsolicitud' => $totalsolicitud,
            'totalmensajes' => $totalmensajes,
            'totalproductos' => $totalproductosporaprobar,
            'totalservicios' => $totalserviciosporaprobar,
            'totalprofesionales' => $totalprofesionalesporaprobar,
            'totalcatalago' => $totalcatalago,
            'totalcatalogonav' => $totalproductosporaprobar + $totalserviciosporaprobar + $totalprofesionalesporaprobar,
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
