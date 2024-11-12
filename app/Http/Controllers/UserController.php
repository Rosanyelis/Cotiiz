<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUser;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::with('roles')->where('id', '!=', 1);
            return DataTables::of($data)
                ->addColumn('actions', function ($data) {
                    return view('users.partials.actions', ['data' => $data]);
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->getRoleNames()[0] == 'admin') {
            $roles = Role::all();
        } else {
            $roles = Role::where('name', '!=', 'admin')->get();
        }

        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $data = $request->all();
        $user = User::create($data);
        return redirect()->route('user.index')->with('success', 'Usuario creado con exito');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = User::find($id);
        if (Auth::user()->getRoleNames()[0] == 'admin') {
            $roles = Role::all();
        } else {
            $roles = Role::where('name', '!=', 'admin')->get();
        }
        return view('users.edit', compact('data', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        $data = $request->all();
        $user = User::find($id);
        if ($data['password'] == null) {
            unset($data['password']);
        } else {
            $data['password'] = Hash::make($data['password']);
        }
        $user->update($data);
        return redirect()->route('user.index')->with('success', 'Usuario actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = User::find($id);
        if ($data->todolists()->count() > 0) {
            return redirect()->route('user.index')->with('error', 'No se puede eliminar el usuario, posee registros relacionados');
        }
        $data->delete();

        return redirect()->route('user.index')->with('success', 'Usuario eliminado con exito');
    }

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
