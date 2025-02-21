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
        return 'Index Function';
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
