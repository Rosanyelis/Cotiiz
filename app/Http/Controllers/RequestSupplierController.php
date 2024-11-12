<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SupplierRequest;
use App\Models\SupplierRequestChat;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreSupplierRequestChatRequest;

class RequestSupplierController extends Controller
{
    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $data = SupplierRequest::where('rfc_suppliers_id', Auth::user()->rfcsuppliers()->first()->id);
            return DataTables::of($data)
                ->addColumn('actions', function ($data) {
                    return view('request-suppliers.partials.actions', ['data' => $data]);
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
        return view('request-suppliers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = SupplierRequest::with('chats')->find($id);
        return view('request-suppliers-chat.index', compact('data'));
    }

    public function storeChat(StoreSupplierRequestChatRequest $request, $id)
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
            'rfc_suppliers_id' => $id,
            'supplier_request_id' => $request->supplier_request_id,
            'supplier_id' => Auth::user()->id,
            'message' => $request->message,
            'file' => $urlfile,
            'name_file' => $nameFile
        ]);
        return redirect()->back()->with('success', 'Mensaje enviado con exito');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
