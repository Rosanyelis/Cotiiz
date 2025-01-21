<?php

namespace App\Http\Controllers\Bussines;

use App\Models\BussinesRequest;
use App\Models\BussinesRequestChat;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBussinesRequestChatRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BussinesRequestChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $data = BussinesRequest::with('chats')->find($id);
        return view('request-bussines-chat.index', compact('data', 'id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeChat(StoreBussinesRequestChatRequest $request)
    {
        // Validar el request
        $request->validate([
            'bussines_request_id' => 'required|exists:bussines_requests,id',
            'message' => 'required|string',
        ]);

        // Verificar que el bussines_request_id exista
        $bussinesRequest = BussinesRequest::find($request->bussines_request_id);

        if (!$bussinesRequest) {
            return redirect()->back()->withErrors(['error' => 'La solicitud no existe.']);
        }

        $urlfile = null;
        $nameFile = null;

        // Procesar archivo si existe
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $nameFile = $file->getClientOriginalName(); // Obtener el nombre original del archivo
            $fileName = time() . rand(111, 699) . '.' . $file->getClientOriginalExtension();
            $uploadPath = public_path('/storage/rfc_bussines/requests/');
            $file->move($uploadPath, $fileName);
            $urlfile = '/storage/rfc_bussines/requests/' . $fileName;
        }

        // Crear el mensaje en el chat
        BussinesRequestChat::create([
            'rfc_bussines_id' => $request->rfc_bussines_id,
            'bussines_request_id' => $request->bussines_request_id,
            'bussines_id' => Auth::user()->id,
            'message' => $request->message,
            'file' => $urlfile,
            'name_file' => $nameFile, // Guardar el nombre del archivo
        ]);

        return redirect()->back()->with('success', 'Mensaje enviado con éxito.');
    }

    /**
     * Cambiar el estado de una solicitud.
     */
    public function changeStatus(Request $request, $bussinesRequest)
    {
        $data = BussinesRequest::find($bussinesRequest);
        $data->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Estatus cambiado con éxito.');
    }
}
