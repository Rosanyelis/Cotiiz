<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use App\Models\RfcBussines;
use App\Models\RfcSupplier;
use Illuminate\Http\Request;
use App\Models\UserRfcBussines;
use App\Models\UserRfcSupplier;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;

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
        return view('auth.register', compact('rfc', 'tipo', 'registrado'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'number_plant'          => ['required'],
            'file_positive_opinion' => ['required', 'mimes:pdf', 'max:2048'],
            'file_bank_information' => ['required', 'mimes:pdf', 'max:2048'],
            'file_fiscal_constancy'  => ['required', 'mimes:pdf', 'max:2048'],
            'file_fiscal_address'    => ['required', 'mimes:pdf', 'max:2048'],
            'phone'                  => ['required'],
            'main_activity'          => ['required'],
            'country'                => ['required'],
            'state'                  => ['required'],
            'municipality'           => ['required'],
            'colony'                => ['required'],
            'street'                 => ['required'],
            'street_number'          => ['required'],
            'postal_code'           => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required'],
            // 'password' => ['required', 'confirmed', Rules\Password::defaults()],

        ],
        [
            'number_plant.required' => 'El campo es obligatorio',
            'file_positive_opinion.required' => 'El campo es obligatorio',
            'file_positive_opinion.mimes' => 'El archivo debe ser PDF',
            'file_positive_opinion.max' => 'El archivo no debe ser mayor a 2MB',
            'file_bank_information.required' => 'El campo es obligatorio',
            'file_bank_information.mimes' => 'El archivo debe ser PDF',
            'file_bank_information.max' => 'El archivo no debe ser mayor a 2MB',
            'file_fiscal_constancy.required' => 'El campo es obligatorio',
            'file_fiscal_constancy.mimes' => 'El archivo debe ser PDF',
            'file_fiscal_constancy.max' => 'El archivo no debe ser mayor a 2MB',
            'file_fiscal_address.required' => 'El campo es obligatorio',
            'file_fiscal_address.mimes' => 'El archivo debe ser PDF',
            'file_fiscal_address.max' => 'El archivo no debe ser mayor a 2MB',
            'phone.required' => 'El campo es obligatorio',
            'main_activity.required' => 'El campo es obligatorio',
            'country.required' => 'El campo es obligatorio',
            'state.required' => 'El campo es obligatorio',
            'municipality.required' => 'El campo es obligatorio',
            'colony.required' => 'El campo es obligatorio',
            'street.required' => 'El campo es obligatorio',
            'street_number.required' => 'El campo es obligatorio',
            'postal_code.required' => 'El campo es obligatorio',
            'name.required' => 'El campo es obligatorio',
            'email.required' => 'El campo es obligatorio',
            'email.email' => 'El correo no es valido',
            'email.unique' => 'El correo ya existe',
            'password.required' => 'El campo es obligatorio',
            'password.confirmed' => 'Las contraseñas no coinciden',
        ]);

        $data = $request->all();
        if ($request->tipo == 'empresa')
        {

            if($request->hasFile('file_positive_opinion'))
            {
                $file = $request->file('file_positive_opinion');
                $fileName   = time().rand(111,699).'.' .$file->getClientOriginalExtension();
                $uploadPath = public_path('/storage/rfc_bussines/');
                $file->move($uploadPath, $fileName);
                $data['file_positive_opinion'] = $url = '/storage/rfc_bussines/'.$fileName;
            }
            if($request->hasFile('file_bank_information'))
            {
                $file = $request->file('file_bank_information');
                $fileName   = time().rand(111,699).'.' .$file->getClientOriginalExtension();
                $uploadPath = public_path('/storage/rfc_bussines/');
                $file->move($uploadPath, $fileName);
                $data['file_bank_information'] = $url = '/storage/rfc_bussines/'.$fileName;
            }

            if($request->hasFile('file_fiscal_constancy'))
            {
                $file = $request->file('file_fiscal_constancy');
                $fileName   = time().rand(111,699).'.' .$file->getClientOriginalExtension();
                $uploadPath = public_path('/storage/rfc_bussines/');
                $file->move($uploadPath, $fileName);
                $data['file_fiscal_constancy'] = $url = '/storage/rfc_bussines/'.$fileName;
            }

            if($request->hasFile('file_fiscal_address'))
            {
                $file = $request->file('file_fiscal_address');
                $fileName   = time().rand(111,699).'.' .$file->getClientOriginalExtension();
                $uploadPath = public_path('/storage/rfc_bussines/');
                $file->move($uploadPath, $fileName);
                $data['file_fiscal_address'] = $url = '/storage/rfc_bussines/'.$fileName;
            }

            $count = RfcBussines::where('name', $data['rfc'])->count();

            $bussines = RfcBussines::create([
                'name'                      => $data['rfc'],
                'number_plant'              => $data['number_plant'],
                'file_positive_opinion'     => $data['file_positive_opinion'],
                'file_bank_information'     => $data['file_bank_information'],
                'file_fiscal_constancy'     => $data['file_fiscal_constancy'],
                'file_fiscal_address'       => $data['file_fiscal_address'],
                'phone'                     => $data['phone'],
                'main_activity'             => $data['main_activity'],
                'country'                   => $data['country'],
                'state'                     => $data['state'],
                'municipality'              => $data['municipality'],
                'colony'                    => $data['colony'],
                'street'                    => $data['street'],
                'street_number'             => $data['street_number'],
                'postal_code'              => $data['postal_code'],
            ]);

            $user = User::create([
                'type' => 'business',
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $user->assignRole('Empresa');


            UserRfcBussines::create([
                'user_id' => $user->id,
                'rfc_bussines_id' => $bussines->id,
                'principal' => $count == 0 ? true : false,
            ]);
        } else if ($request->tipo == 'proveedor')
        {

            if($request->hasFile('file_positive_opinion'))
            {
                $file = $request->file('file_positive_opinion');
                $fileName   = time().rand(111,699).'.' .$file->getClientOriginalExtension();
                $uploadPath = public_path('/storage/rfc_supplier/');
                $file->move($uploadPath, $fileName);
                $data['file_positive_opinion'] = $url = '/storage/rfc_supplier/'.$fileName;
            }
            if($request->hasFile('file_bank_information'))
            {
                $file = $request->file('file_bank_information');
                $fileName   = time().rand(111,699).'.' .$file->getClientOriginalExtension();
                $uploadPath = public_path('/storage/rfc_supplier/');
                $file->move($uploadPath, $fileName);
                $data['file_bank_information'] = $url = '/storage/rfc_supplier/'.$fileName;
            }

            if($request->hasFile('file_fiscal_constancy'))
            {
                $file = $request->file('file_fiscal_constancy');
                $fileName   = time().rand(111,699).'.' .$file->getClientOriginalExtension();
                $uploadPath = public_path('/storage/rfc_supplier/');
                $file->move($uploadPath, $fileName);
                $data['file_fiscal_constancy'] = $url = '/storage/rfc_supplier/'.$fileName;
            }

            if($request->hasFile('file_fiscal_address'))
            {
                $file = $request->file('file_fiscal_address');
                $fileName   = time().rand(111,699).'.' .$file->getClientOriginalExtension();
                $uploadPath = public_path('/storage/rfc_supplier/');
                $file->move($uploadPath, $fileName);
                $data['file_fiscal_address'] = $url = '/storage/rfc_supplier/'.$fileName;
            }

            $count = RfcSupplier::where('name', $data['rfc'])->count();

            $supplier = RfcSupplier::create([
                'name'                      => $data['rfc'],
                'number_plant'              => $data['number_plant'],
                'file_positive_opinion'     => $data['file_positive_opinion'],
                'file_bank_information'     => $data['file_bank_information'],
                'file_fiscal_constancy'     => $data['file_fiscal_constancy'],
                'file_fiscal_address'       => $data['file_fiscal_address'],
                'phone'                     => $data['phone'],
                'main_activity'             => $data['main_activity'],
                'country'                   => $data['country'],
                'state'                     => $data['state'],
                'municipality'              => $data['municipality'],
                'colony'                    => $data['colony'],
                'street'                    => $data['street'],
                'street_number'             => $data['street_number'],
                'postal_code'              => $data['postal_code'],
            ]);

            $user = User::create([
                'type' => 'provider',
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $user->assignRole('Proveedor');

            UserRfcSupplier::create([
                'user_id' => $user->id,
                'rfc_suppliers_id' => $supplier->id,
                'principal' => $count == 0 ? true : false,
            ]);
        }

        # Correo para notificar al usuario registrado que se ha creado su cuenta
        # Correo para notificar al administrador que se ha registrado un nuevo usuario

        return redirect()->route('welcome')->with('success', 'Registrado con exito');
    }

    public function storeUsers(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required'],
        ],
        [
            'name.required' => 'El nombre es obligatorio',
            'email.required' => 'El correo es obligatorio',
            'password.required' => 'La contraseña es obligatoria',
        ]);

        $data = $request->all();
        if ($data['tipo'] == 'proveedor') {
            $data['type'] = 'provider-operador';
            $role = 'Proveedor-Operador';

            $user = User::create($data);

            $user->assignRole($role);

            $provider = RfcSupplier::where('name', $data['rfc'])->first();

            UserRfcSupplier::create([
                'user_id' => $user->id,
                'rfc_suppliers_id' => $provider->id,
            ]);
        }
        if ($data['tipo'] == 'empresa') {
            $data['type'] = 'business-operador';
            $role = 'Empresa-Operador';

            $user = User::create($data);

            $user->assignRole($role);

            $bussines = RfcBussines::where('name', $data['rfc'])->first();

            UserRfcBussines::create([
                'user_id' => $user->id,
                'rfc_bussines_id' => $bussines->id,
            ]);
        }

        return redirect()->route('welcome')->with('success', 'Usuario creado con exito');
    }
}
