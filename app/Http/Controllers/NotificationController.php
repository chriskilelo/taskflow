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
