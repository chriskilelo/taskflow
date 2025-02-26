<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve the 'search' and 'trashed' filters from the request
        $filters = request()->only('search', 'trashed');

        // Fetch the notifications with pagination and apply the filters
        $notifications = Notification::query()
            // Apply filtering using the 'search' and 'trashed' filters from the request
            ->filter($filters)
            // Paginate the results (10 per page)
            ->paginate(10)
            // Append query parameters to the pagination links for state persistence
            ->appends(request()->query())
            // Transform each notification to return the required data
            ->through(function ($notification) {
                return [
                    'id' => $notification->id,
                    'subject' => shortenString($notification->subject, 40),
                    'message' => shortenString($notification->message, 40),
                    'type' => $notification->type,
                    'status' => $notification->status,
                    'created_by' => $notification->created_by,
                    'created_at' => $notification->created_at,
                    'deleted_at' => $notification->deleted_at,
                    'send_attempts' => $notification->send_attempts,
                    'scheduled_at' => $notification->scheduled_at,
                    'sent_at' => $notification->sent_at,
                    'is_active' => $notification->is_active,
                    'is_sent' => $notification->is_sent,
                    'has_error' => $notification->has_error,
                    'failed_at' => $notification->failed_at,
                    'error_message' => $notification->error_message,
                ];
            });

        // Return the Inertia response with the required data
        return inertia()->render('Notifications/Index', [
            'filters' => request()->all('search', 'trashed'),
            'notifications' => $notifications,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return 'Create Function';
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return 'Store Function';
    }

    /**
     * Display the specified resource.
     */
    public function show(Notification $notification)
    {
        return 'Show Function';
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Notification $notification)
    {
        return 'Edit Function';
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Notification $notification)
    {
        return 'Update Function';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notification $notification)
    {
        return 'Destroy Function';
    }
}
