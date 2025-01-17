<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\RfcBussines;
use App\Mail\UserRegistered;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\UserRfcBussines;
use App\Mail\UserRegisteredAdmin;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreRfcBussinesRequest;
use App\Http\Requests\StoreUserBussinesRequest;
use App\Http\Requests\UpdateRfcBussinesRequest;
use App\Http\Requests\StoreUserRfcBussinesRequest;
use App\Http\Requests\UpdateUserRfcBussinesRequest;

class RfcBussinesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = RfcBussines::orderBy('id', 'desc');
            return DataTables::of($data)
                ->addColumn('actions', function ($data) {
                    return view('admin.rfcbussines.partials.actions', ['data' => $data]);
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('admin.rfcbussines.index');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.rfcbussines.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRfcBussinesRequest $request)
    {
        $file_positive_opinion = "";
        $file_bank_information = "";
        $file_fiscal_constancy = "";
        $file_fiscal_address = "";
        if($request->hasFile('file_positive_opinion'))
        {
            $file = $request->file('file_positive_opinion');
            $fileName   = time().rand(111,699).'.' .$file->getClientOriginalExtension();
            $uploadPath = public_path('/storage/rfc_bussines/');
            $file->move($uploadPath, $fileName);
            $file_positive_opinion = $url = '/storage/rfc_bussines/'.$fileName;
        }
        if($request->hasFile('file_bank_information'))
        {
            $file = $request->file('file_bank_information');
            $fileName   = time().rand(111,699).'.' .$file->getClientOriginalExtension();
            $uploadPath = public_path('/storage/rfc_bussines/');
            $file->move($uploadPath, $fileName);
            $file_bank_information = $url = '/storage/rfc_bussines/'.$fileName;
        }

        if($request->hasFile('file_fiscal_constancy'))
        {
            $file = $request->file('file_fiscal_constancy');
            $fileName   = time().rand(111,699).'.' .$file->getClientOriginalExtension();
            $uploadPath = public_path('/storage/rfc_bussines/');
            $file->move($uploadPath, $fileName);
            $file_fiscal_constancy = $url = '/storage/rfc_bussines/'.$fileName;
        }

        if($request->hasFile('file_fiscal_address'))
        {
            $file = $request->file('file_fiscal_address');
            $fileName   = time().rand(111,699).'.' .$file->getClientOriginalExtension();
            $uploadPath = public_path('/storage/rfc_bussines/');
            $file->move($uploadPath, $fileName);
            $file_fiscal_address = $url = '/storage/rfc_bussines/'.$fileName;
        }

        $count = RfcBussines::where('name', $request->rfc)->count();

        $bussines = RfcBussines::create([
            'name'                      => $request->rfc,
            'name_fantasy'              => $request->name_fantasy,
            'number_plant'              => $request->number_plant,
            'file_positive_opinion'     => $file_positive_opinion,
            'file_bank_information'     => $file_bank_information,
            'file_fiscal_constancy'     => $file_fiscal_constancy,
            'file_fiscal_address'       => $file_fiscal_address,
            'phone'                     => $request->phone,
            'main_activity'             => $request->main_activity,
            'country'                   => $request->country,
            'state'                     => $request->state,
            'municipality'              => $request->municipality,
            'colony'                    => $request->colony,
            'street'                    => $request->street,
            'street_number'             => $request->street_number,
            'postal_code'              => $request->postal_code,
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'passwordshow' => $request->password,
        ]);

        $user->assignRole('Empresa');


        UserRfcBussines::create([
            'user_id' => $user->id,
            'rfc_bussines_id' => $bussines->id,
            'principal' => $count == 0 ? 'Si' : 'No',
        ]);

        Notification::create([
            'rfc_bussines_id' => $bussines->id,
            'type' => 'Admin',
            'user_id' => $user->id,
            'title' => 'Nuevo Usuario de Empresa',
            'message' => 'El usuario ' . $user->name . ' de la empresa ' . $bussines->name . ' se ha registrado en el sistema',
        ]);

        # Correo para notificar al usuario registrado que se ha creado su cuenta
        Mail::to($user->email)->send(new UserRegistered($user));

        # Correo para notificar al administrador que se ha registrado un nuevo usuario
        Mail::to('rosanyelismendoza@gmail.com')->send(new UserRegisteredAdmin($user));

        return redirect()->route('business.index')->with('success', 'Empresa Creada con exito');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = RfcBussines::find($id);
        return view('admin.rfcbussines.show', compact('data'));
    }
    # Atajo de usuarios
    /**
     * Show the form for editing the specified resource.
     */
    public function create_user_bussines()
    {
        $rfcs = RfcBussines::all();
        $roles = Role::all();
        return view('admin.rfcbussines.create_user_bussines', compact('rfcs', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function store_user_bussines(StoreUserBussinesRequest $request)
    {
        $file_gafete = "";
        $file_gafete2 = "";
        $file_credential = "";
        $file_credential2 = "";

        if($request->hasFile('file_gafete'))
        {
            $file = $request->file('file_gafete');
            $fileName   = time().rand(111,699).'.' .$file->getClientOriginalExtension();
            $uploadPath = public_path('/storage/rfc_bussines/');
            $file->move($uploadPath, $fileName);
            $file_gafete = $url = '/storage/rfc_bussines/'.$fileName;
        }
        if($request->hasFile('file_gafete2'))
        {
            $file = $request->file('file_gafete2');
            $fileName   = time().rand(111,699).'.' .$file->getClientOriginalExtension();
            $uploadPath = public_path('/storage/rfc_bussines/');
            $file->move($uploadPath, $fileName);
            $file_gafete2 = $url = '/storage/rfc_bussines/'.$fileName;
        }

        if($request->hasFile('file_credential'))
        {
            $file = $request->file('file_credential');
            $fileName   = time().rand(111,699).'.' .$file->getClientOriginalExtension();
            $uploadPath = public_path('/storage/rfc_bussines/');
            $file->move($uploadPath, $fileName);
            $file_credential = $url = '/storage/rfc_bussines/'.$fileName;
        }

        if($request->hasFile('file_credential2'))
        {
            $file = $request->file('file_credential2');
            $fileName   = time().rand(111,699).'.' .$file->getClientOriginalExtension();
            $uploadPath = public_path('/storage/rfc_bussines/');
            $file->move($uploadPath, $fileName);
            $file_credential2 = $url = '/storage/rfc_bussines/'.$fileName;
        }

        $bussines = RfcBussines::find($request->rfcbussines_id);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'passwordshow' => $request->password,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'second_name' => $request->second_name,
            'second_lastname' => $request->second_lastname,
            'workstation' => $request->workstation,
            'phone' => $request->phone_personal,
            'area_work' => $request->area_work,
            'file_gafete' => $file_gafete,
            'file_gafete2' => $file_gafete2,
            'file_credential' => $file_credential,
            'file_credential2' => $file_credential2
        ]);

        $user->assignRole('Empresa-Operador');


        UserRfcBussines::create([
            'user_id' => $user->id,
            'rfc_bussines_id' => $bussines->id,
            'principal' => 'No',
        ]);

        Notification::create([
            'rfc_bussines_id' => $request->id,
            'type' => 'Admin',
            'user_id' => $user->id,
            'title' => 'Nuevo Usuario',
            'message' => 'El usuario ' . $user->name . ' de la empresa ' . $bussines->name . ' se ha registrado en el sistema',
        ]);

        # Correo para notificar al usuario registrado que se ha creado su cuenta
        Mail::to($user->email)->send(new UserRegistered($user));

        # Correo para notificar al administrador que se ha registrado un nuevo usuario
        Mail::to('rosanyelismendoza@gmail.com')->send(new UserRegisteredAdmin($user));

        return redirect()->route('business.index')->with('success', 'Usuario creado con exito');
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

   public function delete($user)
    {
        $data = RfcBussines::find($user);
        $data->users()->delete();
        $data->delete();
        return redirect()->back()->with('success', 'Empresas eliminada con exito');
    } 

    public function store_cashback(Request $request)
    {

        if ($request->cashback == null) {
            return redirect()->back()->with('error', 'Cashback no puede estar vacio');
        }

        $rfc = RfcBussines::find($request->rfc);
        $rfc->cashback = $request->cashback;
        $rfc->save();
        return redirect()->back()->with('success', 'Cashback Actualizado con exito');
    }

#   Usuarios

    public function rfcusers($rfc, Request $request)
    {
        if ($request->ajax()) {
            $dato = User::join('user_rfc_bussines', 'user_rfc_bussines.user_id', '=', 'users.id')
                ->where('user_rfc_bussines.rfc_bussines_id', $rfc)
                ->select('users.*', 'user_rfc_bussines.principal', 'user_rfc_bussines.rfc_bussines_id');
            return DataTables::of($dato)
                ->addColumn('actions', function ($dato) {
                    return view('admin.rfcbussines.partials.actionusers', [ 'data' => $dato]);
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

    }

    public function create_users($rfc)
    {
        $data = RfcBussines::find($rfc);
        return view('admin.rfcbussines.users.create-user', ['rfc' => $rfc, 'data' => $data]);
    }

    public function store_users($rfc, StoreUserRfcBussinesRequest $request)
    {
        $file_gafete = "";
        $file_gafete2 = "";
        $file_credential = "";
        $file_credential2 = "";

        if($request->hasFile('file_gafete'))
        {
            $file = $request->file('file_gafete');
            $fileName   = time().rand(111,699).'.' .$file->getClientOriginalExtension();
            $uploadPath = public_path('/storage/rfc_bussines/');
            $file->move($uploadPath, $fileName);
            $file_gafete = $url = '/storage/rfc_bussines/'.$fileName;
        }
        if($request->hasFile('file_gafete2'))
        {
            $file = $request->file('file_gafete2');
            $fileName   = time().rand(111,699).'.' .$file->getClientOriginalExtension();
            $uploadPath = public_path('/storage/rfc_bussines/');
            $file->move($uploadPath, $fileName);
            $file_gafete2 = $url = '/storage/rfc_bussines/'.$fileName;
        }

        if($request->hasFile('file_credential'))
        {
            $file = $request->file('file_credential');
            $fileName   = time().rand(111,699).'.' .$file->getClientOriginalExtension();
            $uploadPath = public_path('/storage/rfc_bussines/');
            $file->move($uploadPath, $fileName);
            $file_credential = $url = '/storage/rfc_bussines/'.$fileName;
        }

        if($request->hasFile('file_credential2'))
        {
            $file = $request->file('file_credential2');
            $fileName   = time().rand(111,699).'.' .$file->getClientOriginalExtension();
            $uploadPath = public_path('/storage/rfc_bussines/');
            $file->move($uploadPath, $fileName);
            $file_credential2 = $url = '/storage/rfc_bussines/'.$fileName;
        }

        $user = User::create([
            'type' => 'business-operador',
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'passwordshow' => $request->password,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'second_name' => $request->second_name,
            'second_lastname' => $request->second_lastname,
            'workstation' => $request->workstation,
            'phone' => $request->phone_personal,
            'colony' => $request->colony,
            'municipality' => $request->municipality,
            'state' => $request->state,
            'country' => $request->country,     
            'street' => $request->street, 
            'area_work' => $request->area_work,
            'file_gafete' => $file_gafete,
            'file_gafete2' => $file_gafete2,
            'file_credential' => $file_credential,
            'file_credential2' => $file_credential2
        ]);

        $user->assignRole('Empresa-Operador');

        UserRfcBussines::create([
            'user_id' => $user->id,
            'rfc_bussines_id' => $rfc
        ]);
        return redirect()->route('business.show', $rfc)->with('success', 'Usuario creado con exito');
    }

    public function show_users($cliente, $user)
    {
        $data = RfcBussines::find($cliente);
        $data_user = User::find($user);
        return view('admin.rfcbussines.users.show-user', ['user' => $data_user, 'data' => $data]);
    }

    public function edit_users($rfc, $id)
    {
        $data = RfcBussines::find($rfc);
        $user = User::find($id);
        return view('admin.rfcbussines.users.edit-user', ['rfc' => $rfc, 'data' => $data, 'user' => $user]);
    }

    public function update_users($cliente, $user, UpdateUserRfcBussinesRequest $request)
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
            $uploadPath = public_path('/storage/rfc_bussines/');
            $file->move($uploadPath, $fileName);
            $file_gafete = $url = '/storage/rfc_bussines/'.$fileName;
        }
        if($request->hasFile('file_gafete2'))
        {
            $file = $request->file('file_gafete2');
            $fileName   = time().rand(111,699).'.' .$file->getClientOriginalExtension();
            $uploadPath = public_path('/storage/rfc_bussines/');
            $file->move($uploadPath, $fileName);
            $file_gafete2 = $url = '/storage/rfc_bussines/'.$fileName;
        }

        if($request->hasFile('file_credential'))
        {
            $file = $request->file('file_credential');
            $fileName   = time().rand(111,699).'.' .$file->getClientOriginalExtension();
            $uploadPath = public_path('/storage/rfc_bussines/');
            $file->move($uploadPath, $fileName);
            $file_credential = $url = '/storage/rfc_bussines/'.$fileName;
        }

        if($request->hasFile('file_credential2'))
        {
            $file = $request->file('file_credential2');
            $fileName   = time().rand(111,699).'.' .$file->getClientOriginalExtension();
            $uploadPath = public_path('/storage/rfc_bussines/');
            $file->move($uploadPath, $fileName);
            $file_credential2 = $url = '/storage/rfc_bussines/'.$fileName;
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

        return redirect()->route('business.show', $cliente)->with('success', 'Usuario actualizado con exito');
    }

    public function destroy_users($cliente, $user)
    {
        $user = User::find($user);
        $user->delete();

        return redirect()->route('business.show', $cliente)->with('success', 'Usuario eliminado con exito');
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
}
