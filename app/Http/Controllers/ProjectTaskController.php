<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use Illuminate\Support\Facades\Auth;

class ProjectTaskController extends Controller
{
    public function create(Project $project, TaskRequest $request)
    {
        $project->tasks()->create([
            'body' => $request->body
        ]);

        return redirect()->back();
    }

    public function completed(Task $task)
    {
        if (Auth::user()->can("created", $task)) {
            $task->update([
                'completed' => !$task->completed
            ]);
            
            return redirect()->route('project.show', ['project' => $task->id_project]);
        }

        abort(403);
    }
}
