<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\RfcSupplier;
use Illuminate\Http\Request;
use App\Models\UserRfcSupplier;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreRfcSupplierRequest;
use App\Http\Requests\UpdateRfcSupplierRequest;
use App\Http\Requests\StoreUserRfcSupplierRequest;

class RfcSupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = RfcSupplier::all();
            return DataTables::of($data)
                ->addColumn('actions', function ($data) {
                    return view('rfcsupplier.partials.actions', ['data' => $data]);
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('rfcsupplier.index');
    }

    public function rfcusers($rfc, Request $request)
    {
        if ($request->ajax()) {
            $dato = User::join('user_rfc_suppliers', 'user_rfc_suppliers.user_id', '=', 'users.id')
                ->where('user_rfc_suppliers.rfc_suppliers_id', $rfc)
                ->select('users.*', 'user_rfc_suppliers.principal');
            return DataTables::of($dato )
                ->addColumn('actions', function ($dato) {
                    return view('rfcbussines.partials.actionusers', [ 'data' => $dato]);
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

    }

    public function create_users($rfc)
    {
        return view('rfcsupplier.users.create-user', ['rfc' => $rfc]);
    }

    public function store_users($rfc, StoreUserRfcSupplierRequest $request)
    {
        $data = $request->all();
        $data['type'] = 'provider-operador';
        $user = User::create($data);

        $user->assignRole('Proveedor-Operador');

        UserRfcSupplier::create([
            'user_id' => $user->id,
            'rfc_suppliers_id' => $rfc
        ]);
        return redirect()->route('supplier.show', $rfc)->with('success', 'Usuario creado con exito');
    }

    public function ActivateUsers($user)
    {
        $data = User::find($user);
        $data->status = '1';
        $data->save();

        return redirect()->back()->with('success', 'Usuario activado con exito');
    }

    public function DesactivateUsers($user)
    {
        $data = User::find($user);
        $data->status = '0';
        $data->save();

        return redirect()->back()->with('success', 'Usuario Desactivado con exito');
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
    public function store(StoreRfcSupplierRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = RfcSupplier::find($id);
        return view('rfcsupplier.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RfcSupplier $rfcSupplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRfcSupplierRequest $request, RfcSupplier $rfcSupplier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function activated($user)
    {
        $data = RfcSupplier::find($user);
        $data->status = '1';
        $data->save();

        return redirect()->back()->with('success', 'Proveedor Aprobado con exito');
    }

    public function desactivated($user)
    {
        $data = RfcSupplier::find($user);
        $data->status = '0';
        $data->save();

        return redirect()->back()->with('success', 'Proveedor Desactivado con exito');
    }
}
