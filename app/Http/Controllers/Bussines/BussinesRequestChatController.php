<?php

namespace App\Http\Controllers\Bussines;

use App\Models\BussinesRequest;
use App\Models\BussinesRequestChat;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBussinesRequestChatRequest;
use App\Http\Requests\UpdateBussinesRequestChatRequest;

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

        
        $urlfile = null;
        $nameFile = null;
        if($request->hasFile('file'))
        {
            $file = $request->file('file');
            $nameFile = $file->getClientOriginalName();
            $fileName   = time().rand(111,699).'.' .$file->getClientOriginalExtension();
            $uploadPath = public_path('/storage/rfc_bussines/requests/');
            $file->move($uploadPath, $fileName);
            $urlfile = '/storage/rfc_bussines/requests/'.$fileName;

        }

        BussinesRequestChat::create([
            'rfc_bussines_id' => $request->rfc_bussines_id,
            'bussines_request_id' => $request->bussines_request_id,
            'bussines_id' => auth()->user()->id,
            'message' => $request->message,
            'file' => $urlfile,
            'name_file' => $nameFile
        ]);
        return redirect()->back()->with('success', 'Mensaje enviado con exito');
    }

    public function changeStatus(Request $request, $bussinesRequest)
    {
        $data = BussinesRequest::find($bussinesRequest);
        $data->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Estatus cambiado con exito');
    }
}
