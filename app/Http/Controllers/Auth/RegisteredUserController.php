<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\RfcPrueba;
use Illuminate\View\View;
use App\Models\RfcBussines;
use App\Models\RfcSupplier;
use App\Mail\UserRegistered;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\UserRfcPrueba;
use App\Models\UserRfcBussines;
use App\Models\UserRfcSupplier;
use Illuminate\Validation\Rules;
use App\Mail\UserRegisteredAdmin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\StoreBussinesRequest;
use App\Http\Requests\StoreSuppliersRequest;
use App\Http\Requests\StoreBussinesPruebaRequest;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(Request $request): View
    {
        $rfc = $request->rfc;
        $tipo = $request->tipo;
        if ($tipo == 'proveedor') {
            $count = RfcSupplier::where('name', $rfc)->count();
            $registrado = 0;
            if ($count > 0) {
                $registrado = 1;
            }
        }
        if ($tipo == 'empresa') {
            $count = RfcBussines::where('name', $rfc)->count();
            $registrado = 0;
            if ($count > 0) {
                $registrado = 1;
            }
        }
        if ($tipo == 'Empresa-Prueba') {
            $count = RfcBussines::where('name', $rfc)->count();
            $registrado = 0;
            if ($count > 0) {
                $registrado = 1;
            }
        }
        return view('auth.register', compact('rfc', 'tipo', 'registrado'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function storeSupplier(StoreSuppliersRequest $request): RedirectResponse
    {
        $file_fiscal_constancy = "";
        $file_positive_opinion = "";
        $file_bank_information = "";
        $file_credit_acceptance_letter = "";
        $file_list_product_service = "";

        if($request->hasFile('file_fiscal_constancy'))
        {
            $file = $request->file('file_fiscal_constancy');
            $fileName   = time().rand(111,699).'.' .$file->getClientOriginalExtension();
            $uploadPath = public_path('/storage/rfc_supplier/');
            $file->move($uploadPath, $fileName);
            $file_fiscal_constancy = $url = '/storage/rfc_supplier/'.$fileName;
        }
        if($request->hasFile('file_positive_opinion'))
        {
            $file = $request->file('file_positive_opinion');
            $fileName   = time().rand(111,699).'.' .$file->getClientOriginalExtension();
            $uploadPath = public_path('/storage/rfc_supplier/');
            $file->move($uploadPath, $fileName);
            $file_positive_opinion = $url = '/storage/rfc_supplier/'.$fileName;
        }
        if($request->hasFile('file_bank_information'))
        {
            $file = $request->file('file_bank_information');
            $fileName   = time().rand(111,699).'.' .$file->getClientOriginalExtension();
            $uploadPath = public_path('/storage/rfc_supplier/');
            $file->move($uploadPath, $fileName);
            $file_bank_information = $url = '/storage/rfc_supplier/'.$fileName;
        }
        if($request->hasFile('file_credit_acceptance_letter'))
        {
            $file = $request->file('file_credit_acceptance_letter');
            $fileName   = time().rand(111,699).'.' .$file->getClientOriginalExtension();
            $uploadPath = public_path('/storage/rfc_supplier/');
            $file->move($uploadPath, $fileName);
            $file_credit_acceptance_letter = $url = '/storage/rfc_supplier/'.$fileName;
        }
        if($request->hasFile('file_list_product_service'))
        {
            $file = $request->file('file_list_product_service');
            $fileName   = time().rand(111,699).'.' .$file->getClientOriginalExtension();
            $uploadPath = public_path('/storage/rfc_supplier/');
            $file->move($uploadPath, $fileName);
            $file_list_product_service = $url = '/storage/rfc_supplier/'.$fileName;
        }

        $count = RfcSupplier::where('name', $request->rfc)->count();

        $supplier = RfcSupplier::create([
            'name'                          => $request->rfc,
            'name_fantasy'                  => $request->name_fantasy,
            'file_fiscal_constancy'         => $file_fiscal_constancy,
            'file_positive_opinion'         => $file_positive_opinion,
            'file_bank_information'         => $file_bank_information,
            'file_credit_acceptance_letter' => $file_credit_acceptance_letter,
            'file_list_product_service'     => $file_list_product_service,
            'phone'                         => $request->phone,
            'main_activity'                 => $request->main_activity,
            'country'                       => $request->country,
            'state'                         => $request->state,
            'municipality'                  => $request->municipality,
            'colony'                        => $request->colony,
            'street'                        => $request->street,
            'street_number'                 => $request->street_number,
            'postal_code'                   => $request->postal_code,
        ]);

        $user = User::create([
            'type'          => 'Provider',
            'name'          => $request->name,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'passwordshow'  => $request->password,
        ]);

        $user->assignRole('Proveedor');

        UserRfcSupplier::create([
            'user_id' => $user->id,
            'rfc_suppliers_id' => $supplier->id,
            'principal' => $count == 0 ? 'Si' : 'No',
        ]);

        Notification::create([
            'rfc_suppliers_id' => $supplier->id,
            'type' => 'Admin',
            'user_id' => $user->id,
            'title' => 'Nuevo Usuario de Proveedor',
            'message' => 'El usuario ' . $user->name . ' del proveedor ' . $supplier->name . ' se ha registrado en el sistema',
        ]);

        # Correo para notificar al usuario registrado que se ha creado su cuenta
        Mail::to($user->email)->send(new UserRegistered($user));

        # Correo para notificar al administrador que se ha registrado un nuevo usuario
        Mail::to('rosanyelismendoza@gmail.com')->send(new UserRegisteredAdmin($user));


        return redirect()->route('welcome')->with('success', 'Registrado con exito');
    }

    public function storeBussines(StoreBussinesRequest $request)
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

        return redirect()->route('welcome')->with('success', 'Registrado con exito');
    }

    public function storeBussinesPrueba(StoreBussinesPruebaRequest $request)
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

        $count = RfcPrueba::where('name', $request->rfc)->count();
        $bussines = RfcPrueba::create([
            'name'                      => $request->rfc,
            'name_fantasy'              => $request->name_fantasy,
            'phone'                     => $request->phone,
            'country'                   => $request->country,
            'state'                     => $request->state,
            'municipality'              => $request->municipality,
            'colony'                    => $request->colony,
            'street'                    => $request->street
        ]);

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

        $user->assignRole('Empresa-Prueba');


        UserRfcPrueba::create([
            'user_id' => $user->id,
            'rfc_prueba_id' => $bussines->id,
            'principal' => $count == 0 ? 'Si' : 'No',
        ]);

        Notification::create([
            'rfc_prueba_id' => $bussines->id,
            'type' => 'Admin',
            'user_id' => $user->id,
            'title' => 'Nuevo Usuario de Prueba',
            'message' => 'El usuario ' . $user->name . ' de la empresa de prueba ' . $bussines->name . ' se ha registrado en el sistema',
        ]);

        # Correo para notificar al usuario registrado que se ha creado su cuenta
        Mail::to($user->email)->send(new UserRegistered($user));

        # Correo para notificar al administrador que se ha registrado un nuevo usuario
        Mail::to('rosanyelismendoza@gmail.com')->send(new UserRegisteredAdmin($user));

        return redirect()->route('welcome')->with('success', 'Usuario creado con exito');
    }
    public function storeUsers(StoreBussinesPruebaRequest $request)
    {

        $file_gafete = "";
        $file_gafete2 = "";
        $file_credential = "";
        $file_credential2 = "";


        if ($request->tipo == 'empresa')
        {
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

            $bussines = RfcBussines::where('name', $request->rfc)->first();
            $count = RfcBussines::where('name', $request->rfc)->count();

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
                'principal' => $count == 0 ? 'Si' : 'No',
            ]);

            Notification::create([
                'rfc_bussines_id' => $bussines->id,
                'type' => 'Admin',
                'user_id' => $user->id,
                'title' => 'Nuevo Usuario Empleado',
                'message' => 'El usuario ' . $user->name . ' de la empresa ' . $bussines->name . ' se ha registrado en el sistema',
            ]);

            # Correo para notificar al usuario registrado que se ha creado su cuenta
            Mail::to($user->email)->send(new UserRegistered($user));

            # Correo para notificar al administrador que se ha registrado un nuevo usuario
            Mail::to('rosanyelismendoza@gmail.com')->send(new UserRegisteredAdmin($user));

        }
        if ($request->tipo == 'proveedor') {
            $supplier = RfcSupplier::where('name', $request->rfc)->first();
            $count = RfcSupplier::where('name', $request->rfc)->count();

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

            $user->assignRole('Proveedor-Operador');


            UserRfcSupplier::create([
                'user_id' => $user->id,
                'rfc_suppliers_id' => $supplier->id,
                'principal' => $count == 0 ? 'Si' : 'No',
            ]);

            Notification::create([
                'rfc_suppliers_id' => $supplier->id,
                'type' => 'Admin',
                'user_id' => $user->id,
                'title' => 'Nuevo Usuario Empleado',
                'message' => 'El usuario ' . $user->name . ' del proveedor ' . $supplier->name . ' se ha registrado en el sistema',
            ]);

            # Correo para notificar al usuario registrado que se ha creado su cuenta
            Mail::to($user->email)->send(new UserRegistered($user));

            # Correo para notificar al administrador que se ha registrado un nuevo usuario
            Mail::to('rosanyelismendoza@gmail.com')->send(new UserRegisteredAdmin($user));

        }

        return redirect()->route('welcome')->with('success', 'Usuario creado con exito');
    }
}
