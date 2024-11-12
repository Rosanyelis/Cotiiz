<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\RfcBussines;
use Illuminate\Http\Request;
use App\Models\UserRfcBussines;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreRfcBussinesRequest;
use App\Http\Requests\UpdateRfcBussinesRequest;
use App\Http\Requests\StoreUserRfcBussinesRequest;

class RfcBussinesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = RfcBussines::all();
            return DataTables::of($data)
                ->addColumn('actions', function ($data) {
                    return view('rfcbussines.partials.actions', ['data' => $data]);
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('rfcbussines.index');
    }

    public function rfcusers($rfc, Request $request)
    {
        if ($request->ajax()) {
            $dato = User::join('user_rfc_bussines', 'user_rfc_bussines.user_id', '=', 'users.id')
                ->where('user_rfc_bussines.rfc_bussines_id', $rfc)
                ->select('users.*', 'user_rfc_bussines.principal');
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
        return view('rfcbussines.users.create-user', ['rfc' => $rfc]);
    }

    public function store_users($rfc, StoreUserRfcBussinesRequest $request)
    {
        $data = $request->all();
        $data['type'] = 'business-operador';
        $user = User::create($data);

        $user->assignRole('Empresa-Operador');

        UserRfcBussines::create([
            'user_id' => $user->id,
            'rfc_bussines_id' => $rfc
        ]);
        return redirect()->route('business.show', $rfc)->with('success', 'Usuario creado con exito');
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
    public function store(StoreRfcBussinesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = RfcBussines::find($id);
        return view('rfcbussines.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RfcBussines $rfcBussines)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRfcBussinesRequest $request, RfcBussines $rfcBussines)
    {
        //
    }

    public function activated($user)
    {
        $data = RfcBussines::find($user);
        $data->status = '1';
        $data->save();

        return redirect()->back()->with('success', 'Empresa Aprobada con exito');
    }

    public function desactivated($user)
    {
        $data = RfcBussines::find($user);
        $data->status = '0';
        $data->save();

        return redirect()->back()->with('success', 'Empresa Desactivada con exito');
    }

}
