<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class UsersSupplierController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::with('rfcsuppliers')->role(['Proveedor', 'Proveedor-Operador'])->get();
            return DataTables::of($data)
                ->addColumn('actions', function ($data) {
                    return view('admin.userssuppliers.partials.actions', ['data' => $data]);
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('admin.userssuppliers.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = User::find($id);
        return view('admin.userssuppliers.show', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function changePasword(Request $request)
    {
        if ($request->password == null) {
            return redirect()->back()->with('error', 'La contraseña no puede estar vacia');
        }

        $user = User::find($request->id);
        $user->passwordshow = $request->password;
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->back()->with('success', 'Contraseña actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function activated($user)
    {
        $data = User::find($user);
        $data->status = '1';
        $data->save();

        return redirect()->back()->with('success', 'Usuario Aprobada con exito');
    }

    public function desactivated($user)
    {
        $data = User::find($user);
        $data->status = '2';
        $data->save();

        return redirect()->back()->with('success', 'Usuario Desactivado con exito');
    }
}
