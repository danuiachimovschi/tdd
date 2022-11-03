<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProjectRequest;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = auth()->user()->projects()->orderBy("updated_at")->get();

        return view('project.index', compact('projects'));
    }

    public function store(ProjectRequest $request)
    {
        $request->createProduct();

        return redirect('/projects');
    }

    public function show(Project $project)
    {
        if (Auth::user()->can('view', $project)) {
            return view('project.show', compact('project'));
        }

        abort(403);
    }

    public function create()
    {
        return view('project.create');
    }
}
