<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNotificationTypeRequest;
use App\Http\Requests\UpdateNotificationTypeRequest;
use App\Models\NotificationType;
use Illuminate\Http\Request;

class NotificationTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve the 'search' and 'trashed' filters from the request
        $filters = request()->only('search', 'trashed');

        // Fetch the notification types with pagination and apply the filters
        $notificationTypes = NotificationType::query()
            // Apply filtering using the 'search' and 'trashed' filters from the request
            ->filter($filters)
            // Paginate the results (10 per page)
            ->paginate(10)
            // Append query parameters to the pagination links for state persistence
            ->appends(request()->query())
            // Transform each notification type to return the required data
            ->through(function ($notificationType) {
                return [
                    'id' => $notificationType->id,
                    'type' => $notificationType->type,
                    'description' => $notificationType->description,
                    'is_active' => $notificationType->is_active,
                    'created_by' => $notificationType->created_by,
                    'created_at' => $notificationType->created_at,
                    'deleted_at' => $notificationType->deleted_at,
                ];
            });

        // Return the Inertia response with the required data
        return inertia()->render('NotificationTypes/Index', [
            'filters' => request()->all('search', 'trashed'),
            'notification_types' => $notificationTypes,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Use Inertia to render the 'Create' notification types view
        return inertia()->render('NotificationTypes/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNotificationTypeRequest $request)
    {
        // Create a new notification type with the validated data
        NotificationType::create($request->validated());

        // Redirect to the notification types index page with a success message
        return redirect()->route('notification-types.index')->with('success', 'Notification Type created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(NotificationType $notificationType)
    {
        return 'Show Function';
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NotificationType $notificationType)
    {
        // Use Inertia to render the 'Edit' notification types view
        return inertia()->render('NotificationTypes/Edit', [
            'notification_type' => [
                'id' => $notificationType->id,
                'type' => $notificationType->type,
                'description' => $notificationType->description,
                'is_active' => $notificationType->is_active,
                'created_by' => $notificationType->created_by,
                'created_at' => $notificationType->created_at,
                'deleted_at' => $notificationType->deleted_at,
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNotificationTypeRequest $request, NotificationType $notificationType)
    {
        // Update the notification type with the validated data
        $notificationType->update($request->validated());

        // Redirect to the notification types index page with a success message
        return redirect()->route('notification-types.index')->with('success', 'Notification Type updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NotificationType $notificationType)
    {
        return 'Destroy Function';
    }
}
