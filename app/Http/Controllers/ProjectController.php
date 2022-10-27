<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Requests\ProjectRequest;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = auth()->user()->projects;

        return view('project.index', compact('projects'));
    }

    public function store(ProjectRequest $request)
    {
        $request->createProduct();

        return redirect('/projects');
    }

    public function show(Project $project)
    {
        if(auth()->user()->isNotOwner($project->id_owner)){
            abort(403);
        }
        
        return view('project.show', compact('project'));
    }
}
