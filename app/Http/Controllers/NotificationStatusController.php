<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNotificationStatusRequest;
use App\Http\Requests\UpdateNotificationStatusRequest;
use App\Models\NotificationStatus;

class NotificationStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve the 'search' and 'trashed' filters from the request
        $filters = request()->only('search', 'trashed');

        // Fetch the notification statuses with pagination and apply the filters
        $notificationStatuses = NotificationStatus::query()
            // Apply filtering using the 'search' and 'trashed' filters from the request
            ->filter($filters)
            // Paginate the results (10 per page)
            ->paginate(10)
            // Append query parameters to the pagination links for state persistence
            ->appends(request()->query())
            // Transform each notification status to return the required data
            ->through(function ($notificationStatus) {
                return [
                    'id' => $notificationStatus->id,
                    'status' => $notificationStatus->status,
                    'description' => $notificationStatus->description,
                    'is_active' => $notificationStatus->is_active,
                    'created_by' => $notificationStatus->created_by,
                    'created_at' => $notificationStatus->created_at,
                    'deleted_at' => $notificationStatus->deleted_at,
                ];
            });

        // Return the Inertia response with the required data
        return inertia()->render('NotificationStatuses/Index', [
            'filters' => request()->all('search', 'trashed'),
            'notification_statuses' => $notificationStatuses,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia()->render('NotificationStatuses/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNotificationStatusRequest $request)
    {
        return "Store Function";
    }

    /**
     * Display the specified resource.
     */
    public function show(NotificationStatus $notificationStatus)
    {
        return "Show Function";
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NotificationStatus $notificationStatus)
    {
        return "Edit Function";
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNotificationStatusRequest $request, NotificationStatus $notificationStatus)
    {
        return "Update Function";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NotificationStatus $notificationStatus)
    {
        return "Destroy Function";
    }
}
