<?php

namespace App\Http\Controllers\Admin;

use App\Models\Occupation;
use Illuminate\Http\Request;
use App\Imports\OccupationsImport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreOccupationRequest;
use App\Http\Requests\UpdateOccupationRequest;
use App\Http\Requests\StoreImportOccupationRequest;

class OccupationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Occupation::all();
            return DataTables::of($data)
                ->addColumn('actions', function ($data) {
                    return view('admin.occupations.partials.actions', ['id' => $data->id]);
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('admin.occupations.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.occupations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOccupationRequest $request)
    {
        Occupation::create($request->all());
        return redirect()->route('occupation.index')->with('success', 'Profesión creada con exito');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Occupation $occupation)
    {
        return view('admin.occupations.edit', compact('occupation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOccupationRequest $request, Occupation $occupation)
    {
        $occupation->update($request->all());
        return redirect()->route('occupation.index')->with('success', 'Profesión actualizada con exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Occupation $occupation)
    {
        if ($occupation->professionals()->count() > 0) {
            return redirect()->route('occupation.index')->with('error', 'La Profesión no puede ser eliminada, tiene registros relacionados');
        };
        $occupation->delete();
        return redirect()->route('occupation.index')->with('success', 'Profesión eliminada con exito');
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function viewimport()
    {
        return view('admin.occupations.import');
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function storeimport(StoreImportOccupationRequest $request)
    {
        Excel::import(new OccupationsImport, $request->file('archivo'));
        return redirect()->route('occupation.index')->with('success', 'Profesiones importadas con exito');
    }
}
