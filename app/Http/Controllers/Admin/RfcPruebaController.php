<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\RfcPrueba;
use Illuminate\Http\Request;
use App\Models\UserRfcPrueba;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreUserRfcPruebaRequest;
use App\Http\Requests\UpdateUserRfcSupplierRequest;

class RfcPruebaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = RfcPrueba::orderBy('id', 'desc');
            return DataTables::of($data)
                ->addColumn('actions', function ($data) {
                    return view('admin.rfcpruebas.partials.actions', ['data' => $data]);
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('admin.rfcpruebas.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = RfcPrueba::find($id);
        return view('admin.rfcpruebas.show', compact('data'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function activated($user)
    {
        $data = RfcPrueba::find($user);
        $data->status = '1';
        $data->save();

        return redirect()->back()->with('success', 'Empresa Pruebas Aprobado con exito');
    }

    public function desactivated($user)
    {
        $data = RfcPrueba::find($user);
        $data->status = '0';
        $data->save();

        return redirect()->back()->with('success', 'Empresa Pruebas Desactivado con exito');
    }

    public function delete($id)
    {
        $data = RfcPrueba::find($id);
        $data->users()->delete();
        $data->delete();
        return redirect()->back()->with('success', 'Proveedor eliminado con exito');
    }

    public function rfcusers($rfc, Request $request)
    {
        if ($request->ajax()) {
            $dato = User::join('user_rfc_pruebas', 'user_rfc_pruebas.user_id', '=', 'users.id')
                ->where('user_rfc_pruebas.rfc_prueba_id', $rfc)
                ->select('users.*', 'user_rfc_pruebas.principal', 'user_rfc_pruebas.rfc_prueba_id');
            return DataTables::of($dato )
                ->addColumn('actions', function ($dato) {
                    return view('admin.rfcpruebas.partials.actionusers', [ 'data' => $dato]);
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

    }

    public function create_users($rfc)
    {
        return view('admin.rfcpruebas.users.create-user', ['rfc' => $rfc]);
    }

    public function store_users($rfc, StoreUserRfcPruebaRequest $request)
    {
        $file_gafete = "";
        $file_gafete2 = "";
        $file_credential = "";
        $file_credential2 = "";

        if($request->hasFile('file_gafete'))
        {
            $file = $request->file('file_gafete');
            $fileName   = time().rand(111,699).'.' .$file->getClientOriginalExtension();
            $uploadPath = public_path('/storage/rfc_pruebas/');
            $file->move($uploadPath, $fileName);
            $file_gafete = $url = '/storage/rfc_pruebas/'.$fileName;
        }
        if($request->hasFile('file_gafete2'))
        {
            $file = $request->file('file_gafete2');
            $fileName   = time().rand(111,699).'.' .$file->getClientOriginalExtension();
            $uploadPath = public_path('/storage/rfc_pruebas/');
            $file->move($uploadPath, $fileName);
            $file_gafete2 = $url = '/storage/rfc_pruebas/'.$fileName;
        }

        if($request->hasFile('file_credential'))
        {
            $file = $request->file('file_credential');
            $fileName   = time().rand(111,699).'.' .$file->getClientOriginalExtension();
            $uploadPath = public_path('/storage/rfc_pruebas/');
            $file->move($uploadPath, $fileName);
            $file_credential = $url = '/storage/rfc_pruebas/'.$fileName;
        }

        if($request->hasFile('file_credential2'))
        {
            $file = $request->file('file_credential2');
            $fileName   = time().rand(111,699).'.' .$file->getClientOriginalExtension();
            $uploadPath = public_path('/storage/rfc_pruebas/');
            $file->move($uploadPath, $fileName);
            $file_credential2 = $url = '/storage/rfc_pruebas/'.$fileName;
        }

        $user = User::create([
            'type'                      => 'business-pruebas',
            'name'                      => $request->name,
            'email'                     => $request->email,
            'password'                  => Hash::make($request->password),
            'passwordshow'              => $request->password,
            'firstname'                 => $request->firstname,
            'lastname'                  => $request->lastname,
            'second_name'               => $request->second_name,
            'second_lastname'           => $request->second_lastname,
            'workstation'               => $request->workstation,
            'phone'                     => $request->phone_personal,
            'area_work'                 => $request->area_work,
            'country'                   => $request->country,
            'state'                     => $request->state,
            'municipality'              => $request->municipality,
            'colony'                    => $request->colony,
            'street'                    => $request->street,
            'file_gafete'               => $file_gafete,
            'file_gafete2'              => $file_gafete2,
            'file_credential'           => $file_credential,
            'file_credential2'          => $file_credential2
        ]);

        $user->assignRole('Empresa-Prueba');

        UserRfcPrueba::create([
            'user_id' => $user->id,
            'rfc_pruebas_id' => $rfc,
            'principal' => 'No'
        ]);
        return redirect()->route('prueba.show', $rfc)->with('success', 'Usuario creado con exito');
    }

    public function show_users($cliente, $user)
    {
        $data = RfcPrueba::find($cliente);
        $data_user = User::find($user);
        return view('admin.rfcpruebas.users.show-user', ['user' => $data_user, 'data' => $data]);
    }

    public function edit_users($rfc, $user)
    {
        $data = RfcPrueba::find($rfc);
        $user = User::find($user);
        return view('admin.rfcpruebas.users.edit-user', ['rfc' => $rfc, 'data' => $data, 'user' => $user]);
    }

    public function update_users($cliente, $user, UpdateUserRfcSupplierRequest $request)
    {
        $user = User::find($user);
        $file_gafete = $user->file_gafete;
        $file_gafete2 = $user->file_gafete2;
        $file_credential = $user->file_credential;
        $file_credential2 = $user->file_credential2;

        if($request->hasFile('file_gafete'))
        {
            $file = $request->file('file_gafete');
            $fileName   = time().rand(111,699).'.' .$file->getClientOriginalExtension();
            $uploadPath = public_path('/storage/rfc_prueba/');
            $file->move($uploadPath, $fileName);
            $file_gafete = $url = '/storage/rfc_prueba/'.$fileName;
        }
        if($request->hasFile('file_gafete2'))
        {
            $file = $request->file('file_gafete2');
            $fileName   = time().rand(111,699).'.' .$file->getClientOriginalExtension();
            $uploadPath = public_path('/storage/rfc_prueba/');
            $file->move($uploadPath, $fileName);
            $file_gafete2 = $url = '/storage/rfc_prueba/'.$fileName;
        }

        if($request->hasFile('file_credential'))
        {
            $file = $request->file('file_credential');
            $fileName   = time().rand(111,699).'.' .$file->getClientOriginalExtension();
            $uploadPath = public_path('/storage/rfc_prueba/');
            $file->move($uploadPath, $fileName);
            $file_credential = $url = '/storage/rfc_prueba/'.$fileName;
        }

        if($request->hasFile('file_credential2'))
        {
            $file = $request->file('file_credential2');
            $fileName   = time().rand(111,699).'.' .$file->getClientOriginalExtension();
            $uploadPath = public_path('/storage/rfc_prueba/');
            $file->move($uploadPath, $fileName);
            $file_credential2 = $url = '/storage/rfc_prueba/'.$fileName;
        }

        if($request->password != null) {
            $user->password = Hash::make($request->password);
        }
        $user->name             = $request->name;
        $user->email            = $request->email;
        $user->firstname        = $request->firstname;
        $user->lastname         = $request->lastname;
        $user->second_name      = $request->second_name;
        $user->second_lastname  = $request->second_lastname;
        $user->workstation      = $request->workstation;
        $user->phone            = $request->phone;
        $user->area_work        = $request->area_work;
        $user->country          = $request->country;
        $user->state            = $request->state;
        $user->municipality     = $request->municipality;
        $user->colony           = $request->colony;
        $user->street           = $request->street;
        $user->file_gafete      = $file_gafete;
        $user->file_gafete2     = $file_gafete2;
        $user->file_credential  = $file_credential;
        $user->file_credential2 = $file_credential2;
        $user->save();

        return redirect()->route('prueba.show', $cliente)->with('success', 'Usuario actualizado con exito');
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

    public function destroy_users($cliente, $user)
    {
        $user = User::find($user);
        $user->delete();

        return redirect()->route('prueba.show', $cliente)->with('success', 'Usuario eliminado con exito');
    }
}
