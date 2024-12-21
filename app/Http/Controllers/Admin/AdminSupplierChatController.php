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
        if($request->hasFile('file'))
        {
            $file = $request->file('file');
            $nameFile = $file->getClientOriginalName();
            $fileName   = time().rand(111,699).'.' .$file->getClientOriginalExtension();
            $uploadPath = public_path('/storage/rfc_supplier/chats/');
            $file->move($uploadPath, $fileName);
            $urlfile = '/storage/rfc_supplier/chats/'.$fileName;

        }

        SuppliersChat::create([
            'rfc_suppliers_id' => $request->rfc_suppliers_id,
            'user_admin_id' => auth()->user()->id,
            'message' => $request->message,
            'file' => $urlfile,
            'name_file' => $nameFile
        ]);

        $data = UserRfcSupplier::with(['user'])
            ->where('rfc_suppliers_id', $request->rfc_suppliers_id)
            ->first();

        $username = $data->user->name;
        # enviar el correo de notificacion
        Mail::to($data->user->email)->send(new NotifyMessageSupplier($username));

        Notification::create([
            'rfc_suppliers_id' => $request->rfc_suppliers_id,
            'type' => 'Proveedor',
            'user_id' => $data->user->id,
            'title' => 'Nuevo mensaje en Buzón',
            'message' => 'En Buzón tiene un nuevo mensaje.'
        ]);

        return redirect()->route('admin.supplier-chat.index')->with('success', 'Mensaje enviado con exito');
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
        if($request->hasFile('file'))
        {
            $file = $request->file('file');
            $nameFile = $file->getClientOriginalName();
            $fileName   = time().rand(111,699).'.' .$file->getClientOriginalExtension();
            $uploadPath = public_path('/storage/rfc_supplier/chats/');
            $file->move($uploadPath, $fileName);
            $urlfile = '/storage/rfc_supplier/chats/'.$fileName;

        }

        SuppliersChat::create([
            'rfc_suppliers_id' => $id,
            'user_admin_id' => auth()->user()->id,
            'message' => $request->message,
            'file' => $urlfile,
            'name_file' => $nameFile
        ]);

        $data = SuppliersChat::with(['supplier'])
            ->where('rfc_suppliers_id', $id)
            ->where('supplier_id', '!=', 'null')
            ->first();

        $username = $data->supplier->name;
        # enviar el correo de notificacion
        Mail::to($data->supplier->email)->send(new NotifyMessageSupplier($username));

        Notification::create([
            'rfc_suppliers_id' => $data->id,
            'type' => 'Proveedor',
            'user_id' => $data->supplier->id,
            'title' => 'Nuevo mensaje en Buzón',
            'message' => 'En Buzón de proveedores tiene un nuevo mensaje.'
        ]);

        return redirect()->back()->with('success', 'Mensaje enviado con exito');
    }
}
