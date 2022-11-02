<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Project;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTaskTest extends TestCase
{  
    use RefreshDatabase;

    protected $project;

    public function setUp(): void
    {
        parent::setUp();

        $this->authUser();
        
        $this->project = Project::factory()->create(['id_owner' => auth()->id()]);
        
        $this->post($this->project->path() . '/tasks', ['body' => 'Test Task']);
    }
    /**
     * @test
     */
    public function check_status()
    {
        $this->get($this->project->path())->assertSee('Test Task');
    }
    
    /**
     * @test
     */
    public function project_can_add_task()
    {
        $this->assertCount(1, $this->project->tasks);
    }

    /**
     * @test
     */
    public function user_can_completed_project_task()
    {
        $task = $this->project->tasks->first();

        $this->patch("/tasks/{$task->id}/completed");
        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'completed' => true
        ]);
    }
}
