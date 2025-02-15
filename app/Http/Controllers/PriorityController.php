<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePriorityRequest;
use App\Http\Requests\UpdatePriorityRequest;
use App\Models\Priority;
use Illuminate\Http\Request;

class PriorityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Retrieve the 'search' and 'trashed' filters from the request
        $filters = $request->only('search', 'trashed');

        // Fetch the priorities with pagination and apply the filters
        $priorities = Priority::query()
            // Apply filtering using the 'search' and 'trashed' filters from the request
            ->filter($filters)
            // Paginate the results (10 per page)
            ->paginate(10)
            // Append query parameters to the pagination links for state persistence
            ->appends($request->query())
            // Transform each priority to return the required data
            ->through(function ($priority) {
                return [
                    'id' => $priority->id,
                    'level' => $priority->level,
                    'description' => $priority->description,
                    'is_active' => $priority->is_active,
                    'created_by' => $priority->created_by,
                    'created_at' => $priority->created_at,
                    'deleted_at' => $priority->deleted_at,
                ];
            });

        // Return the Inertia response with the required data
        return inertia()->render('Priorities/Index', [
            'filters' => $request->all('search', 'trashed'),
            'priorities' => $priorities,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia()->render('Priorities/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePriorityRequest $request)
    {
        // Create a new priority with the validated data
        Priority::create($request->validated());

        // Redirect to the priorities index page with a success message
        return redirect()->route('priorities.index')->with('success', 'Priority created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Priority $priority)
    {
        return 'Show Function';
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Priority $priority)
    {
        return inertia()->render('Priorities/Edit', [
            'priority' => [
                'id' => $priority->id,
                'level' => $priority->level,
                'description' => $priority->description,
                'is_active' => $priority->is_active,
                'created_by' => $priority->created_by,
                'created_at' => $priority->created_at,
                'deleted_at' => $priority->deleted_at,
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePriorityRequest $request, Priority $priority)
    {
        // Update the priority with the validated data
        $priority->update($request->validated());

        // Redirect to the priorities index page with a success message
        return redirect()->route('priorities.index')->with('success', 'Priority updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Priority $priority)
    {
        // Soft delete the priority
        $priority->delete();

        // Redirect to the priorities index page with a success message
        return redirect()->route('priorities.index')->with('success', 'Priority deleted.');
    }
}
