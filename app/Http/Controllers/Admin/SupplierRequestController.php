<?php

namespace App\Http\Controllers\Admin;

use App\Models\RfcSupplier;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\SupplierRequest;
use App\Models\SupplierRequestChat;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendNotifyRequestSupplier;
use App\Mail\SendMessageRequestSupplier;
use Yajra\DataTables\Facades\DataTables;
use App\Mail\ChangeStatusRequestSupplier;
use App\Http\Requests\StoreSupplierRequestRequest;
use App\Http\Requests\UpdateSupplierRequestRequest;
use App\Http\Requests\StoreSupplierRequestChatRequest;

class SupplierRequestController extends Controller
{
    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $data = SupplierRequest::with('user', 'supplier')->get();
            return DataTables::of($data)
                ->addColumn('actions', function ($data) {
                    return view('admin.supplier-requests.partials.actions', ['data' => $data]);
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
        return view('admin.supplier-requests.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rfcSuppliers = RfcSupplier::all();
        return view('admin.supplier-requests.create', compact('rfcSuppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSupplierRequestRequest $request)
    {
        $data = SupplierRequest::create([
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
            'supplier_request_id' => $data->id,
            'user_admin_id' => auth()->user()->id,
            'message' => $request->message,
            'file' => $request->file
        ]);

        # enviar el correo de notificacion
        Mail::to($data->user->email)->send(new SendNotifyRequestSupplier($data));

        Notification::create([
            'rfc_suppliers_id' => $data->rfc_suppliers_id,
            'type' => 'Proveedor',
            'user_id' => $data->user->id,
            'title' => 'Nueva Solicitud',
            'message' => 'Ha recibido una nueva solicitud de ' . $data->type.'.'
        ]);

        return redirect()->route('request-supplier.index')->with('success', 'Solicitud creada con exito');
    }

    /**
     * Display the specified resource.
     */
    public function show($supplierRequest)
    {
        $data = SupplierRequest::with('chats')->find($supplierRequest);
        return view('admin.supplier-request-chat.index', compact('data'));
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
            'name_file' => $nameFile
        ]);

        $data = SupplierRequest::with('user')->find($supplierRequest);

        # enviar el correo de notificacion
        Mail::to($data->user->email)->send(new SendMessageRequestSupplier($data));

        Notification::create([
            'rfc_suppliers_id' => $data->rfc_suppliers_id,
            'type' => 'Proveedor',
            'user_id' => $data->user->id,
            'title' => 'Nuevo mensaje en solicitud',
            'message' => 'La solicitud ' . $data->type . ' tiene un nuevo mensaje.'
        ]);

        return redirect()->back()->with('success', 'Mensaje enviado con exito');
    }


    public function changeStatus(Request $request, $supplierRequest)
    {
        $data = SupplierRequest::find($supplierRequest);
        $data->update([
            'status' => $request->status
        ]);

        # enviar el correo de notificacion
        Mail::to($data->user->email)->send(new ChangeStatusRequestSupplier($data));

        Notification::create([
            'rfc_suppliers_id' => $data->rfc_suppliers_id,
            'type' => 'Admin',
            'user_id' => $data->user->id,
            'title' => 'Cambio de estatus de solicitud',
            'message' => 'La solicitud ' . $data->type . ' ha cambiado de estatus.'
        ]);

        Notification::create([
            'rfc_suppliers_id' => $data->rfc_suppliers_id,
            'type' => 'Proveedor',
            'user_id' => $data->user->id,
            'title' => 'Cambio de estatus de solicitud',
            'message' => 'La solicitud ' . $data->type . ' ha cambiado de estatus.'
        ]);

        return redirect()->back()->with('success', 'Estatus cambiado con exito');
    }
}
