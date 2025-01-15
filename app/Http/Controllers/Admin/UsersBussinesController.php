<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class UsersBussinesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::with('rfcbussines')->role(['Empresa', 'Empresa-Operador'])->get();
            return DataTables::of($data)
                ->addColumn('actions', function ($data) {
                    return view('admin.usersbussines.partials.actions', ['data' => $data]);
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('admin.usersbussines.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = User::find($id);
        return view('admin.usersbussines.show', compact('data'));
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

    public function getPassword($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado.'], 404);
        }

        return response()->json(['passwordshow' => $user->passwordshow], 200);
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

    public function delete($id)
    {
        $data = User::find($id);
        $data->delete();
        return redirect()->back()->with('success', 'Usuario eliminado con exito');
    }
}
