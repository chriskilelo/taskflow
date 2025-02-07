<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStatusRequest;
use App\Http\Requests\UpdateStatusRequest;
use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Retrieve the 'search' and 'trashed' filters from the request
        $filters = $request->only('search', 'trashed');

        // Fetch the statuses with pagination and apply the filters
        $statuses = Status::query()
            // Apply filtering using the 'search' and 'trashed' filters from the request
            ->filter($filters)
            // Paginate the results (10 per page)
            ->paginate(10)
            // Append query parameters to the pagination links for state persistence
            ->appends($request->query())
            // Transform each status to return the required data
            ->through(function ($status) {
                return [
                    'id' => $status->id,
                    'status' => $status->status,
                    'description' => $status->description,
                    'is_active' => $status->is_active,
                    'created_at' => $status->created_at,
                    'deleted_at' => $status->deleted_at,
                ];
            });

        // Return the Inertia response with the required data
        return inertia()->render('Statuses/Index', [
            'filters' => $request->all('search', 'trashed'),
            'statuses' => $statuses,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia()->render('Statuses/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStatusRequest $request)
    {
        // Validate the incoming request
        $validated = $request->validated();

        // Create a new status with the validated data
        Status::create($validated);

        // Redirect to the statuses index page with a success message
        return redirect()->route('statuses.index')->with('success', 'Status created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(status $status)
    {
        return "Show function";
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(status $status)
    {
        // Return the Inertia response with the required data
        return inertia()->render('Statuses/Edit', [
            'status' => [
                'id' => $status->id,
                'status' => $status->status,
                'description' => $status->description,
                'created_by' => $status->created_by,
                'created_at' => $status->created_at,
                'deleted_at' => $status->deleted_at,
                'is_active' => $status->is_active,
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStatusRequest $request, status $status)
    {
        // Validate the incoming request
        $validated = $request->validated();

        // Update the status with the validated data
        $status->update($validated);

        // Redirect to the statuses index page with a success message
        return redirect()->route('statuses.index')->with('success', 'Status updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(status $status)
    {
        // Soft delete the status
        $status->delete();

        // Redirect to the statuses index page with a success message
        return redirect()->route('statuses.index')->with('success', 'Status deleted successfully.');
    }
}
