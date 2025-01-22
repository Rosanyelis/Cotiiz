<?php

namespace App\Http\Controllers\Admin;

use App\Models\RfcSupplier;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\SuppliersChat;
use App\Models\UserRfcSupplier;
use App\Mail\NotifyMessageSupplier;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreChatSupplierRequest;
use App\Models\Supplier;

class AdminSupplierChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = RfcSupplier::whereHas('chats')
            ->orderBy('id', 'desc')
            ->get();
            return DataTables::of($data)
                ->addColumn('actions', function ($data) {
                    return view('admin.suppliers-chats.partials.actions', ['data' => $data]);
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('admin.suppliers-chats.index');
    }

    public function create()
    {
        $rfcs = RfcSupplier::all();
        return view('admin.suppliers-chats.create', compact('rfcs'));
    }

    public function storeBuzon(StoreChatSupplierRequest $request)
    {
        $urlfile = null;
        $nameFile = null;
    
        // Subir archivo si existe
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $file = $request->file('file');
            $nameFile = $file->getClientOriginalName();
            $fileName = time() . rand(111, 699) . '.' . $file->getClientOriginalExtension();
            $uploadPath = public_path('/storage/rfc_supplier/chats/');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0775, true);
            }
            $file->move($uploadPath, $fileName);
            $urlfile = '/storage/rfc_supplier/chats/' . $fileName;
        }
    
        // Obtener el supplier_id desde el rfc_suppliers_id
        $supplierData = UserRfcSupplier::with(['user'])
            ->where('rfc_suppliers_id', $request->rfc_suppliers_id)
            ->first();
    
        if (!$supplierData) {
            return redirect()->back()->withErrors(['error' => 'No se encontró información del proveedor relacionado.']);
        }
    
        $supplierId = $supplierData->user_id;
        // dd($supplierId, $request->all());    
        // Crear el registro en suppliers_chats
        SuppliersChat::create([
            'rfc_suppliers_id' => $request->rfc_suppliers_id,
            'supplier_id' => $supplierId, // Ahora estamos asignando correctamente el supplier_id
            'user_admin_id' => auth()->user()->id,
            'message' => $request->message,
            'file' => $urlfile,
            'name_file' => $nameFile,
            'sender_type' => 'admin'
        ]);
    
        // Enviar correo de notificación
        $username = $supplierData->user->name;
        Mail::to($supplierData->user->email)->send(new NotifyMessageSupplier($username));
    
        // Crear notificación
        Notification::create([
            'rfc_suppliers_id' => $request->rfc_suppliers_id,
            'type' => 'Proveedor',
            'user_id' => $supplierId,
            'title' => 'Nuevo mensaje en Buzón',
            'message' => 'En Buzón tiene un nuevo mensaje.'
        ]);
    
        return redirect()->route('admin.supplier-chat.index')->with('success', 'Mensaje enviado con éxito');
    }
     

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = RfcSupplier::with('chats')->find($id);
        return view('admin.suppliers-chats.show', compact('data'));
    }

    public function store(StoreChatSupplierRequest $request, $id)
    {
        $urlfile = null;
        $nameFile = null;
    
        // Subir archivo si existe
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $nameFile = $file->getClientOriginalName();
            $fileName = time() . rand(111, 699) . '.' . $file->getClientOriginalExtension();
            $uploadPath = public_path('/storage/rfc_supplier/chats/');
            $file->move($uploadPath, $fileName);
            $urlfile = '/storage/rfc_supplier/chats/' . $fileName;
        }
    
        // Buscar supplier_id basado en el rfc_suppliers_id
        $supplierData = UserRfcSupplier::with('user')
            ->where('rfc_suppliers_id', $id)
            ->first();
    
        if (!$supplierData) {
            return redirect()->back()->withErrors(['error' => 'No se encontró información del proveedor relacionado.']);
        }
    
        $supplierId = $supplierData->user_id;
    
        // Crear el mensaje
        SuppliersChat::create([
            'rfc_suppliers_id' => $id,
            'supplier_id' => $supplierId,
            'user_admin_id' => auth()->user()->id,
            'message' => $request->message,
            'file' => $urlfile,
            'name_file' => $nameFile,
            'sender_type' => 'admin',
        ]);
    
        return redirect()->back()->with('success', 'Mensaje enviado con éxito');
    }
        
}
