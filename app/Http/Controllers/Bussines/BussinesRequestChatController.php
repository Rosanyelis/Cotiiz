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
        $data = BussinesRequest::with(['chats', 'bussines', 'rfcPrueba'])->find($id);
        return view('request-bussines-chat.index', compact('data', 'id'));
    }

    /**
     * Store a newly created resource in storage.
     */

     public function storeChat(StoreBussinesRequestChatRequest $request)
     {
         $urlfile = null;
         $nameFile = null;

         // Manejo del archivo, si existe
         if ($request->hasFile('file')) {
             $file = $request->file('file');
             $nameFile = $file->getClientOriginalName();
             $fileName = time() . rand(111, 699) . '.' . $file->getClientOriginalExtension();

             // Define la ruta de almacenamiento según el tipo de entidad
             $uploadPath = auth()->user()->rfcpruebas()->exists()
                 ? public_path('/storage/rfc_pruebas/requests/')
                 : public_path('/storage/rfc_bussines/requests/');

             // Mover el archivo al directorio adecuado
             $file->move($uploadPath, $fileName);
             $urlfile = ($uploadPath === public_path('/storage/rfc_pruebas/requests/'))
                 ? '/storage/rfc_pruebas/requests/' . $fileName
                 : '/storage/rfc_bussines/requests/' . $fileName;
         }

         // Obtener la solicitud de negocio para determinar el RFC relacionado
         $bussinesRequest = BussinesRequest::find($request->bussines_request_id);

         if (!$bussinesRequest) {
             return redirect()->back()->withErrors(['error' => 'No se encontró la solicitud de negocio asociada.']);
         }

         // Determinar cuál RFC usar
         $rfcBussinesId = $bussinesRequest->rfc_bussines_id;
         $rfcPruebaId = $bussinesRequest->rfc_prueba_id;

         // Crear el mensaje de chat
         BussinesRequestChat::create([
             'rfc_bussines_id' => $rfcBussinesId, // Usar el valor correspondiente o null
             'rfc_prueba_id' => $rfcPruebaId, // Usar el valor correspondiente o null
             'bussines_request_id' => $request->bussines_request_id,
             'bussines_id' => auth()->user()->id,
             'message' => $request->message,
             'file' => $urlfile,
             'name_file' => $nameFile,
         ]);

         return redirect()->back()->with('success', 'Mensaje enviado con éxito');
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
