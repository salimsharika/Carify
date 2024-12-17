<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a list of unread notifications for the logged-in user.
     */
    public function index()
    {
        $notifications = auth()->user()->notifications()->orderBy('created_at', 'desc')->get();
        return view('notifications.index', compact('notifications'));
    }

    /**
     * Mark a notification as read.
     */
    public function markAsRead(Notification $notification)
    {
        // Ensure the notification belongs to the current user
        if ($notification->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $notification->update(['is_read' => true]);
        return redirect()->back()->with('success', 'Notification marked as read.');
    }

    /**
     * Mark all notifications as read for the current user.
     */
    public function markAllAsRead()
    {
        auth()->user()->notifications()->update(['is_read' => true]);
        return redirect()->back()->with('success', 'All notifications marked as read.');
    }
}
