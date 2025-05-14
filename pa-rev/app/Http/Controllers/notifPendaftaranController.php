<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NotifPendaftaran;
use Illuminate\Support\Facades\Auth;

class notifPendaftaranController extends Controller
{
    public function markAsRead($id)
    {
        $notification = NotifPendaftaran::findOrFail($id);
        $notification->update(['is_read' => true]);
        
        return response()->json(['success' => true]);
    }

}
