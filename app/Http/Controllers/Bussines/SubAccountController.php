<?php

namespace App\Http\Controllers\Bussines;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class SubAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::join('user_rfc_bussines', 'users.id', '=', 'user_rfc_bussines.user_id')
                    ->join('rfc_bussines', 'user_rfc_bussines.rfc_bussines_id', '=', 'rfc_bussines.id')
                    ->where('rfc_bussines.id',  Auth::user()->rfcbussines()->first()->id)
                    ->select('users.*', 'user_rfc_bussines.principal');
            return DataTables::of($data)
                ->make(true);
        }
        return view('subaccount.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
