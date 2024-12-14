<?php

namespace App\Http\Controllers\Bussines;

use App\Models\BussinesChat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BussinesChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = BussinesChat::where('user_bussines_id', Auth::user()->id)->get();
        return view('bussines-chat.index', compact('data'));
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
            $uploadPath = public_path('/storage/rfc_bussines/chats/');
            $file->move($uploadPath, $fileName);
            $urlfile = '/storage/rfc_bussines/chats/'.$fileName;
        }

        BussinesChat::create([
            'rfc_bussines_id' => auth()->user()->rfcbussines()->first()->id,
            'user_bussines_id' => auth()->user()->id,
            'message' => $request->message,
            'file' => $urlfile,
            'name_file' => $nameFile
        ]);
        return redirect()->back()->with('success', 'Mensaje enviado con exito');
    }

    /**
     * Display the specified resource.
     */
    public function show(BussinesChat $bussinesChat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BussinesChat $bussinesChat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BussinesChat $bussinesChat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BussinesChat $bussinesChat)
    {
        //
    }
}
