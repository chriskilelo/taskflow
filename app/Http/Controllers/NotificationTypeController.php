<?php

namespace App\Http\Controllers;

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
    public function show(NotificationType $notificationType)
    {
        return 'Show Function';
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NotificationType $notificationType)
    {
        return 'Edit Function';
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, NotificationType $notificationType)
    {
        return 'Update Function';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NotificationType $notificationType)
    {
        return 'Destroy Function';
    }
}
