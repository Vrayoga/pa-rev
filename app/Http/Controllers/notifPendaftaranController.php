<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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


   public function fetchNotifications()
    {
        $userId = Auth::id();
        if (!$userId) {
            return response()->json([
                'notifications' => [],
                'unreadCount' => 0,
            ]);
        }

        $notifications = NotifPendaftaran::where('receiver_id', $userId)
            ->orderBy('created_at', 'desc')
            ->take(10) // Ambil beberapa notifikasi terbaru saja untuk dropdown
            ->get()
            ->map(function ($notification) {
                $notification->formatted_created_at = Carbon::parse($notification->created_at)->diffForHumans();
                return $notification;
            });

        $unreadCount = NotifPendaftaran::where('receiver_id', $userId)
            ->where('is_read', false)
            ->count();

        return response()->json([
            'notifications' => $notifications,
            'unreadCount' => $unreadCount,
        ]);
    }



    public function notif(){
        $userId = Auth::id();
        if (!$userId) {
            return response()->json([
                'notifications' => [],
                'unreadCount' => 0,
            ]);
        }

        $notifications = NotifPendaftaran::where('receiver_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($notification) {
                $notification->formatted_created_at = Carbon::parse($notification->created_at)->diffForHumans();
                return $notification;
            });

        $unreadCount = NotifPendaftaran::where('receiver_id', $userId)
            ->where('is_read', false)
            ->count();

        return view('layout._notifPendaftaran', [
            'notifications' => $notifications,
            'unreadCount' => $unreadCount,
        ]);
    }
}
