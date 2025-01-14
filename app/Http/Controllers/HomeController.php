<?php

namespace App\Http\Controllers;

use App\Models\RfcBussines;
use App\Models\RfcSupplier;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('welcome');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.typeregister');
    }

    public function viewsearchRfc($tipo)
    {
        return view('auth.searchrfc', ['tipo' => $tipo]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function searchRfc($tipo, Request $request)
    {
        if ($tipo == 'proveedor') {
            $data = RfcSupplier::where('name', $request->term)->first();
            return response()->json($data);
        }
        if ($tipo == 'empresa') {
            $data = RfcBussines::where('name', $request->term)->first();
            return response()->json($data);
        }
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
