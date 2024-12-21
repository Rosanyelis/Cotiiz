<?php

namespace App\Http\Controllers\Supplier;

use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SupplierNotificactionController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function get_notifications()
    {
        $data = Notification::where('type', 'Proveedor')
                        ->where('rfc_suppliers_id', Auth::user()->rfcsuppliers()->first()->id)
                        ->orderBy('id', 'desc')
                        ->get();
        $lastNotify = Notification::where('type', 'Proveedor')
                        ->where('rfc_suppliers_id', Auth::user()->rfcsuppliers()->first()->id)
                        ->orderBy('id', 'desc')
                        ->first();

        return response()->json(['data' => $data, 'lastNotify' => $lastNotify]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function markedAsRead()
    {
        Notification::where('type', 'Proveedor')->update(['status' => 'Leido']);
        return response()->json(['status' => 'success']);
    }

    public function read_notification($notification)
    {
        $notification = Notification::where('type', 'Proveedor')->find($notification);
        $notification->update(['status' => 'Leido']);
        return response()->json(['status' => 'success']);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $notification = Notification::where('type', 'Proveedor')->find($id);
        $notification->delete();
        return response()->json(['status' => 'success']);
    }
}
