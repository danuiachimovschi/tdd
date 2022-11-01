<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Project;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTaskTest extends TestCase
{
    /**
     * @test
     */
    public function check_status()
    {
        $this->authUser();
        
        $project = Project::factory()->create(['id_owner' => auth()->id()]);
        
        $this->post($project->path() . '/tasks', ['body' => 'Test Task']);

        $this->get($project->path())->assertSee('Test Task');
    }
    
    /**
     * @test
     */
    public function project_can_add_task()
    {
        $this->authUser();
        
        $project = Project::factory()->create(['id_owner' => auth()->id()]);

        $this->post($project->path() . '/tasks', ['body' => 'Test Task']);

        $this->assertCount(1, $project->tasks);
    }
}
