<?php

namespace App\Http\Controllers\Bussines;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class BussinesUsersController extends Controller
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
                    ->select(
                        'users.id as id',
                        DB::raw('CONCAT(users.firstname, " ", users.lastname) as fullname'),
                        'users.email as email',
                        'users.phone as phone',
                        'users.status as status',
                        'user_rfc_bussines.principal as principal',);
            return DataTables::of($data)
                ->addColumn('actions', function ($data) {
                    return view('bussines-users.partials.actions', compact('data'));
                })
                ->make(true);
        }
        return view('bussines-users.index');
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
