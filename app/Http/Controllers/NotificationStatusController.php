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
        return "Index Function";
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return "Create Function";
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
