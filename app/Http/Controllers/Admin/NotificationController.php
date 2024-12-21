<?php

namespace App\Http\Controllers\Admin;

use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function get_notifications()
    {
        $data = Notification::where('type', 'Admin')
                        ->orderBy('id', 'desc')
                        ->get();
        $lastNotify = Notification::where('type', 'Admin')
                        ->orderBy('id', 'desc')
                        ->first();

        return response()->json(['data' => $data, 'lastNotify' => $lastNotify]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function markedAsRead()
    {
        Notification::where('type', 'Admin')->update(['status' => 'Leido']);
        return response()->json(['status' => 'success']);
    }

    public function read_notification($notification)
    {
        $notification = Notification::find($notification);
        $notification->update(['status' => 'Leido']);
        return response()->json(['status' => 'success']);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $notification = Notification::find($id);
        $notification->delete();
        return response()->json(['status' => 'success']);
    }
}
