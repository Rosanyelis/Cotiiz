<?php

namespace App\Http\Controllers;

use App\Models\RfcSupplier;
use Illuminate\Http\Request;
use App\Models\SupplierRequest;
use App\Models\SupplierRequestChat;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreSupplierRequestRequest;
use App\Http\Requests\UpdateSupplierRequestRequest;
use App\Http\Requests\StoreSupplierRequestChatRequest;

class SupplierRequestController extends Controller
{
    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $data = SupplierRequest::all();
            return DataTables::of($data)
                ->addColumn('actions', function ($data) {
                    return view('supplier-requests.partials.actions', ['data' => $data]);
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('supplier-requests.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rfcSuppliers = RfcSupplier::all();
        return view('supplier-requests.create', compact('rfcSuppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSupplierRequestRequest $request)
    {
        $dato = SupplierRequest::create([
            'rfc_suppliers_id' => $request->rfc_suppliers_id,
            'user_id' => auth()->user()->id,
            'type' => $request->type,
            'observation' => $request->observation
        ]);

        $urlfile = null;
        if($request->hasFile('file'))
        {
            $file = $request->file('file');
            $fileName   = time().rand(111,699).'.' .$file->getClientOriginalExtension();
            $uploadPath = public_path('/storage/rfc_supplier/requests/');
            $file->move($uploadPath, $fileName);
            $urlfile = '/storage/rfc_supplier/requests/'.$fileName;
        }

        SupplierRequestChat::create([
            'rfc_suppliers_id' => $request->rfc_suppliers_id,
            'supplier_request_id' => $dato->id,
            'user_admin_id' => auth()->user()->id,
            'message' => $request->message,
            'file' => $request->file
        ]);

        return redirect()->route('request-supplier.index')->with('success', 'Solicitud creada con exito');
    }

    /**
     * Display the specified resource.
     */
    public function show($supplierRequest)
    {
        $data = SupplierRequest::with('chats')->find($supplierRequest);
        return view('supplier-request-chat.index', compact('data'));
    }

    public function storeChat(StoreSupplierRequestChatRequest $request, $supplierRequest)
    {
        $urlfile = null;
        $nameFile = null;
        if($request->hasFile('file'))
        {
            $file = $request->file('file');
            $nameFile = $file->getClientOriginalName();
            $fileName   = time().rand(111,699).'.' .$file->getClientOriginalExtension();
            $uploadPath = public_path('/storage/rfc_supplier/requests/');
            $file->move($uploadPath, $fileName);
            $urlfile = '/storage/rfc_supplier/requests/'.$fileName;

        }

        SupplierRequestChat::create([
            'rfc_suppliers_id' => $request->rfc_suppliers_id,
            'supplier_request_id' => $supplierRequest,
            'user_admin_id' => auth()->user()->id,
            'message' => $request->message,
            'file' => $urlfile,
            'file_name' => $nameFile
        ]);
        return redirect()->back()->with('success', 'Mensaje enviado con exito');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SupplierRequest $supplierRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSupplierRequestRequest $request, SupplierRequest $supplierRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SupplierRequest $supplierRequest)
    {
        //
    }

    public function changeStatus(Request $request, $supplierRequest)
    {
        $data = SupplierRequest::find($supplierRequest);
        $data->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Estatus cambiado con exito');
    }
}
