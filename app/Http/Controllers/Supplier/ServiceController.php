<?php

namespace App\Http\Controllers\Supplier;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('services.index');
    }

    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $data = Service::where('user_id', auth()->user()->id)
                ->get();
            return DataTables::of($data)
                ->addColumn('actions', function ($data) {
                    return view('services.partials.actions', ['id' => $data->id]);
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
        return view('services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServiceRequest $request)
    {
        $data = $request->all();
        if($request->hasFile('photo'))
        {
            // dd($request->file('photo'));
            $file = $request->file('photo');
            $fileName   = time().rand(111,699).'.' .$file->getClientOriginalExtension();
            $uploadPath = public_path('/storage/rfc_supplier/services/');
            $file->move($uploadPath, $fileName);
            $data['photo'] = $url = '/storage/rfc_supplier/services/'.$fileName;
        }

        $data['user_id'] = auth()->user()->id;
        $data['rfc_suppliers_id'] = auth()->user()->rfcsuppliers()->first()->id;
        $producto = Service::create($data);

        return redirect()->route('service.index')->with('success', 'Servicio creado con exito');
    }

    /**
     * Display the specified resource.
     */
    public function show($service)
    {
        $data = Service::find($service);
        return view('services.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($service)
    {
        $data = Service::find($service);
        return view('services.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServiceRequest $request, $service)
    {
        $data = $request->all();
        if($request->hasFile('photo'))
        {
            $file = $request->file('photo');
            $fileName   = time().rand(111,699).'.' .$file->getClientOriginalExtension();
            $uploadPath = public_path('/storage/rfc_supplier/services/');
            $file->move($uploadPath, $fileName);
            $data['photo'] = $url = '/storage/rfc_supplier/services/'.$fileName;
        }
        $data['user_id'] = auth()->user()->id;
        $data['rfc_suppliers_id'] = auth()->user()->rfcsuppliers()->first()->id;
        $service = Service::find($service);
        $service->update($data);

        return redirect()->route('service.index')->with('success', 'Servicio actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($service)
    {

        $data = Service::find($service);
        $data->delete();
        return redirect()->route('service.index')->with('success', 'Servicio eliminado con exito');
    }
}
