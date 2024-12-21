<?php

namespace App\Http\Controllers\Supplier;

use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\SuppliersChat;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SupplierChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = SuppliersChat::where('supplier_id', Auth::user()->id)->get();
        return view('supplier-chat.index', compact('data'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $urlfile = null;
        $nameFile = null;
        if($request->hasFile('file'))
        {
            $file = $request->file('file');
            $nameFile = $file->getClientOriginalName();
            $fileName   = time().rand(111,699).'.' .$file->getClientOriginalExtension();
            $uploadPath = public_path('/storage/rfc_suppliers/chats/');
            $file->move($uploadPath, $fileName);
            $urlfile = '/storage/rfc_suppliers/chats/'.$fileName;
        }

        SuppliersChat::create([
            'rfc_suppliers_id' => auth()->user()->rfcsuppliers()->first()->id,
            'supplier_id' => auth()->user()->id,
            'message' => $request->message,
            'file' => $urlfile,
            'name_file' => $nameFile
        ]);

        Notification::create([
            'rfc_suppliers_id' => auth()->user()->rfcsuppliers()->first()->id,
            'type' => 'Admin',
            'user_id' => auth()->user()->id,
            'title' => 'Nuevo Mensaje de Proveedor ',
            'message' => 'El usuario ' . auth()->user()->name . ' del proveedor ' . auth()->user()->rfcsuppliers()->first()->name . ' le ha enviado un mensaje',
        ]);

        return redirect()->back()->with('success', 'Mensaje enviado con exito');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
