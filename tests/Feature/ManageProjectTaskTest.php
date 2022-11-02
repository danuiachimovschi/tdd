<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Task;
use App\Models\Project;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageProjectTaskTest extends TestCase
{
    use RefreshDatabase;
    
    protected $task;

    public function setUp(): void
    {
        parent::setUp();

        $this->task = Task::factory()->create();
    }
    /**
     * @test
     */
    public function only_auth_user_can_complet_task()
    {
        $this->patch("/tasks/{$this->task->id}/completed")->assertRedirect('login');
    }

    /**
     * @test
     */
    public function only_owner_can_comple_task()
    {
        $this->authUser();

        $this->patch("/tasks/{$this->task->id}/completed")->assertStatus(403);
    }
}
