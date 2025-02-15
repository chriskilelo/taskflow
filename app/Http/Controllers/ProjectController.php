<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve the 'search' and 'trashed' filters from the request
        $filters = request()->only('search', 'trashed');

        // Fetch the projects with pagination and apply the filters
        $projects = Project::query()
            // Apply filtering using the 'search' and 'trashed' filters from the request
            ->filter($filters)
            // Paginate the results (10 per page)
            ->paginate(10)
            // Append query parameters to the pagination links for state persistence
            ->appends(request()->query())
            // Transform each project to return the required data
            ->through(function ($project) {
                return [
                    'id' => $project->id,
                    'name' => $project->name,
                    'description' => shortenString($project->description, 40),
                    'status' => $project->status,
                    'is_active' => $project->is_active,
                    'created_by' => $project->created_by,
                    'created_at' => $project->created_at,
                    'deleted_at' => $project->deleted_at,
                ];
            });

        // Return the Inertia response with the required data
        return inertia()->render('Projects/Index', [
            'filters' => request()->all('search', 'trashed'),
            'projects' => $projects,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia()->render('Projects/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        // Create a new project with the validated data
        Project::create($request->validated());

        // Redirect to the projects index page with a success message
        return redirect()->route('projects.index')->with('success', 'Project created.');        
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return 'Show Function';
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return 'Edit Function';
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        return 'Update Function';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        return 'Destroy Function';
    }
}
