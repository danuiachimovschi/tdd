<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectTaskController extends Controller
{
    public function create(Project $project, TaskRequest $request)
    {
        $project->tasks()->create([
            'body' => $request->body
        ]);

        return redirect()->back();
    }
}
