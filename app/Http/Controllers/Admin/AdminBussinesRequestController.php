<?php

namespace App\Http\Controllers\Admin;

use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\BussinesRequest;
use App\Models\BussinesRequestChat;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMessageRequestBussines;
use Yajra\DataTables\Facades\DataTables;
use App\Mail\ChangeStatusRequestBussines;
use App\Http\Requests\StoreBussinesRequestChatRequest;

class AdminBussinesRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $data = BussinesRequest::with('bussines')->get();
            return DataTables::of($data)
                ->addColumn('actions', function ($data) {
                    return view('admin.bussines-requests.partials.actions', ['data' => $data]);
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
        return view('admin.bussines-requests.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = BussinesRequest::with('chats')->find($id);
        $msjs = BussinesRequestChat::where('bussines_request_id', $id)->get();
        return view('admin.bussines-requests-chats.index', compact('data', 'msjs'));
    }

    public function storeChat(StoreBussinesRequestChatRequest $request, $bussinesRequest)
    {
        $urlfile = null;
        $nameFile = null;
        if($request->hasFile('file'))
        {
            $file = $request->file('file');
            $fileName   = time().rand(111,699).'.' .$file->getClientOriginalExtension();
            $uploadPath = public_path('/storage/rfc_bussines/requests/');
            $file->move($uploadPath, $fileName);
            $urlfile = '/storage/rfc_bussines/requests/'.$fileName;
            $nameFile = $file->getClientOriginalName();

        }

        BussinesRequestChat::create([
            'rfc_bussines_id' => $request->rfc_bussines_id,
            'bussines_request_id' => $bussinesRequest,
            'user_admin_id' => auth()->user()->id,
            'message' => $request->message,
            'file' => $urlfile,
            'name_file' => $nameFile
        ]);

        $data = BussinesRequest::with('user')->find($bussinesRequest);

        # enviar el correo de notificacion
        Mail::to($data->user->email)->send(new SendMessageRequestBussines($data));

        Notification::create([
            'rfc_bussines_id' => $data->rfc_bussines_id,
            'type' => 'Empresa',
            'user_id' => $data->user->id,
            'title' => 'Nuevo mensaje en solicitud',
            'message' => 'La solicitud ' . $data->type . ' tiene un nuevo mensaje.'
        ]);
        return redirect()->back()->with('success', 'Mensaje enviado con exito');
    }

    public function changeStatus(Request $request, $bussinesRequest)
    {
        $data = BussinesRequest::with('user')->find($bussinesRequest);
        $data->update([
            'status' => $request->status
        ]);

        # enviar el correo de notificacion
        Mail::to($data->user->email)->send(new ChangeStatusRequestBussines($data));

        Notification::create([
            'rfc_bussines_id' => $data->rfc_bussines_id,
            'type' => 'Admin',
            'user_id' => $data->user->id,
            'title' => 'Cambio de estatus de solicitud',
            'message' => 'La solicitud ' . $data->type . ' ha cambiado de estatus.'
        ]);

        Notification::create([
            'rfc_bussines_id' => $data->rfc_bussines_id,
            'type' => 'Empresa',
            'user_id' => $data->user->id,
            'title' => 'Cambio de estatus de solicitud',
            'message' => 'La solicitud ' . $data->type . ' ha cambiado de estatus.'
        ]);

        return redirect()->back()->with('success', 'Estatus cambiado con exito');
    }
}
