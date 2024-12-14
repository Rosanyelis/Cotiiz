<?php

namespace App\Http\Controllers\Admin;

use App\Models\Specialty;
use Illuminate\Http\Request;
use App\Imports\SpecialtiesImport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreSpecialtyRequest;
use App\Http\Requests\UpdateSpecialtyRequest;

class SpecialtyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Specialty::all();
            return DataTables::of($data)
                ->addColumn('actions', function ($data) {
                    return view('admin.specialties.partials.actions', ['id' => $data->id]);
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('admin.specialties.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.specialties.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSpecialtyRequest $request)
    {
        Specialty::create($request->all());
        return redirect()->route('specialty.index')->with('success', 'Especialidad creada con exito');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Specialty $specialty)
    {
        return view('admin.specialties.edit', compact('specialty'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSpecialtyRequest $request, Specialty $specialty)
    {
        $specialty->update($request->all());
        return redirect()->route('specialty.index')->with('success', 'Especialidad actualizada con exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Specialty $specialty)
    {
        if ($specialty->professionals()->count() > 0) {
            return redirect()->route('specialty.index')->with('error', 'La Especialidad no puede ser eliminada, tiene registros relacionados');
        };
        $specialty->delete();
        return redirect()->route('specialty.index')->with('success', 'Especialidad eliminada con exito');
    }

    public function viewimport()
    {
        return view('admin.specialties.import');
    }

    public function storeimport(Request $request)
    {
        Excel::import(new SpecialtiesImport, $request->file('archivo'));
        return redirect()->route('specialty.index')->with('success', 'Especialidades importadas con exito');
    }
}
