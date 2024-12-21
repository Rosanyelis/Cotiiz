<?php

namespace App\Http\Controllers\Supplier;

use App\Models\Specialty;
use App\Models\Occupation;
use App\Models\Notification;
use App\Models\Professional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreProfessionalRequest;
use App\Http\Requests\UpdateProfessionalRequest;

class ProfessionalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('professionals.index');
    }

    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $data = Professional::join('occupations', 'professionals.occupation_id', '=', 'occupations.id')
                ->join('specialties', 'professionals.specialty_id', '=', 'specialties.id')
                ->select('professionals.id', 'professionals.status', 'professionals.file_photo as photo',
                        DB::raw('CONCAT(professionals.firstname, " ", professionals.second_name, " ", professionals.lastname, " ", professionals.second_lastname) as fullname'),
                        'occupations.name as occupation', 'specialties.name as specialty')
                ->where('professionals.user_id', auth()->user()->id);
            return DataTables::of($data)
                ->addColumn('actions', function ($data) {
                    return view('professionals.partials.actions', ['id' => $data->id]);
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $profesions = Occupation::all();
        $specialties = Specialty::all();
        return view('professionals.create', compact('profesions', 'specialties'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProfessionalRequest $request)
    {
        $data = $request->all();
        if($request->hasFile('file_title_trainee_1'))
        {
            $file = $request->file('file_title_trainee_1');
            $fileName   = time().rand(111,699).'.' .$file->getClientOriginalExtension();
            $uploadPath = public_path('/storage/rfc_supplier/professionals/');
            $file->move($uploadPath, $fileName);
            $data['file_title_trainee_1'] = $url = '/storage/rfc_supplier/professionals/'.$fileName;
        }
        if($request->hasFile('file_title_trainee_2'))
        {
            $file = $request->file('file_title_trainee_2');
            $fileName   = time().rand(111,699).'.' .$file->getClientOriginalExtension();
            $uploadPath = public_path('/storage/rfc_supplier/professionals/');
            $file->move($uploadPath, $fileName);
            $data['file_title_trainee_2'] = $url = '/storage/rfc_supplier/professionals/'.$fileName;
        }
        if($request->hasFile('file_cv'))
        {
            $file = $request->file('file_cv');
            $fileName   = time().rand(111,699).'.' .$file->getClientOriginalExtension();
            $uploadPath = public_path('/storage/rfc_supplier/professionals/');
            $file->move($uploadPath, $fileName);
            $data['file_cv'] = $url = '/storage/rfc_supplier/professionals/'.$fileName;
        }
        if($request->hasFile('file_voter_idcard_1'))
        {
            $file = $request->file('file_voter_idcard_1');
            $fileName   = time().rand(111,699).'.' .$file->getClientOriginalExtension();
            $uploadPath = public_path('/storage/rfc_supplier/professionals/');
            $file->move($uploadPath, $fileName);
            $data['file_voter_idcard_1'] = $url = '/storage/rfc_supplier/professionals/'.$fileName;
        }
        if($request->hasFile('file_voter_idcard_2'))
        {
            $file = $request->file('file_voter_idcard_2');
            $fileName   = time().rand(111,699).'.' .$file->getClientOriginalExtension();
            $uploadPath = public_path('/storage/rfc_supplier/professionals/');
            $file->move($uploadPath, $fileName);
            $data['file_voter_idcard_2'] = $url = '/storage/rfc_supplier/professionals/'.$fileName;
        }
        if($request->hasFile('file_photo'))
        {
            $file = $request->file('file_photo');
            $fileName   = time().rand(111,699).'.' .$file->getClientOriginalExtension();
            $uploadPath = public_path('/storage/rfc_supplier/professionals/');
            $file->move($uploadPath, $fileName);
            $data['file_photo'] = $url = '/storage/rfc_supplier/professionals/'.$fileName;
        }


        $data['user_id'] = auth()->user()->id;
        $data['rfc_suppliers_id'] = auth()->user()->rfcsuppliers()->first()->id;
        $producto = Professional::create($data);

        Notification::create([
            'rfc_suppliers_id' => auth()->user()->rfcsuppliers()->first()->id,
            'type' => 'Admin',
            'user_id' => auth()->user()->id,
            'title' => 'Nuevo Profesional de Proveedor ',
            'message' => 'El usuario ' . auth()->user()->name . ' del proveedor ' . auth()->user()->rfcsuppliers()->first()->name . ' ha registrado un Profesional en el sistema',
        ]);

        return redirect()->route('professional.index')->with('success', 'Profesional creado con exito');
    }

    /**
     * Display the specified resource.
     */
    public function show($professional)
    {
        $data = Professional::find($professional);
        return view('professionals.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($professional)
    {
        $profesions = Occupation::all();
        $specialties = Specialty::all();
        $data = Professional::find($professional);
        return view('professionals.edit', compact('data', 'profesions', 'specialties'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProfessionalRequest $request, $professional)
    {

        $data = $request->all();
        if($request->hasFile('file_title_trainee_1'))
        {
            $file = $request->file('file_title_trainee_1');
            $fileName   = time().rand(111,699).'.' .$file->getClientOriginalExtension();
            $uploadPath = public_path('/storage/rfc_supplier/professionals/');
            $file->move($uploadPath, $fileName);
            $data['file_title_trainee_1'] = $url = '/storage/rfc_supplier/professionals/'.$fileName;
        }
        if($request->hasFile('file_title_trainee_2'))
        {
            $file = $request->file('file_title_trainee_2');
            $fileName   = time().rand(111,699).'.' .$file->getClientOriginalExtension();
            $uploadPath = public_path('/storage/rfc_supplier/professionals/');
            $file->move($uploadPath, $fileName);
            $data['file_title_trainee_2'] = $url = '/storage/rfc_supplier/professionals/'.$fileName;
        }
        if($request->hasFile('file_cv'))
        {
            $file = $request->file('file_cv');
            $fileName   = time().rand(111,699).'.' .$file->getClientOriginalExtension();
            $uploadPath = public_path('/storage/rfc_supplier/professionals/');
            $file->move($uploadPath, $fileName);
            $data['file_cv'] = $url = '/storage/rfc_supplier/professionals/'.$fileName;
        }
        if($request->hasFile('file_voter_idcard_1'))
        {
            $file = $request->file('file_voter_idcard_1');
            $fileName   = time().rand(111,699).'.' .$file->getClientOriginalExtension();
            $uploadPath = public_path('/storage/rfc_supplier/professionals/');
            $file->move($uploadPath, $fileName);
            $data['file_voter_idcard_1'] = $url = '/storage/rfc_supplier/professionals/'.$fileName;
        }
        if($request->hasFile('file_voter_idcard_2'))
        {
            $file = $request->file('file_voter_idcard_2');
            $fileName   = time().rand(111,699).'.' .$file->getClientOriginalExtension();
            $uploadPath = public_path('/storage/rfc_supplier/professionals/');
            $file->move($uploadPath, $fileName);
            $data['file_voter_idcard_2'] = $url = '/storage/rfc_supplier/professionals/'.$fileName;
        }
        if($request->hasFile('file_photo'))
        {
            $file = $request->file('file_photo');
            $fileName   = time().rand(111,699).'.' .$file->getClientOriginalExtension();
            $uploadPath = public_path('/storage/rfc_supplier/professionals/');
            $file->move($uploadPath, $fileName);
            $data['file_photo'] = $url = '/storage/rfc_supplier/professionals/'.$fileName;
        }
        $data['user_id'] = auth()->user()->id;
        $data['rfc_suppliers_id'] = auth()->user()->rfcsuppliers()->first()->id;
        Professional::find($professional)->update($data);
        return redirect()->route('professional.index')->with('success', 'Profesional actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($professional)
    {
        $data = Professional::find($professional);
        $data->delete();
        return redirect()->route('professional.index')->with('success', 'Profesional eliminado con exito');
    }
}
