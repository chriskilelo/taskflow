<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNotificationRequest;
use App\Http\Requests\UpdateNotificationRequest;
use App\Models\Notification;
use App\Models\NotificationStatus;
use App\Models\NotificationType;
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
        //Fetch all the Active notification types - for the notification types dropdown
        $notificationTypes = NotificationType::where('is_active', true)->distinct()->pluck('type');
        //Fetch all the Active notification statuses - for the notification status dropdown
        $notificationStatuses = NotificationStatus::where('is_active', true)->distinct()->pluck('status');
        // Use Inertia to render the 'Create' notifications view
        return inertia()->render('Notifications/Create', [
            'notificationTypes' => $notificationTypes,
            'notificationStatuses' => $notificationStatuses,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNotificationRequest $request)
    {
        // Create a new notification with the validated data
        Notification::create($request->validated());

        // Redirect to the notifications index page with a success message
        return redirect()->route('notifications.index')->with('success', 'Notification created successfully.');
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
        //Fetch all the Active notification types - for the notification types dropdown
        $notificationTypes = NotificationType::where('is_active', true)->distinct()->pluck('type');
        //Fetch all the Active notification statuses - for the notification status dropdown
        $notificationStatuses = NotificationStatus::where('is_active', true)->distinct()->pluck('status');
        // Use Inertia to render the 'Edit' notifications view
        return inertia()->render('Notifications/Edit', [
            'notification' => [
                'id' => $notification->id,
                'user_id' => $notification->user_id,
                'subject' => $notification->subject,
                'message' => $notification->message,
                'type' => $notification->type,
                'status' => $notification->status,
                'created_by' => $notification->created_by,
                'send_attempts' => $notification->send_attempts,
                'scheduled_at' => $notification->scheduled_at,
                'sent_at' => $notification->sent_at,
                'is_active' => $notification->is_active,
                'is_sent' => $notification->is_sent,
                'has_error' => $notification->has_error,
                'failed_at' => $notification->failed_at,
                'error_message' => $notification->error_message,
            ],
            'notification_types' => $notificationTypes,
            'notification_statuses' => $notificationStatuses,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNotificationRequest $request, Notification $notification)
    {
        // Update the notification with the validated data
        $notification->update($request->validated());

        // Redirect to the notifications index page with a success message
        return redirect()->route('notifications.index')->with('success', 'Notification updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notification $notification)
    {
        return 'Destroy Function';
    }
}
