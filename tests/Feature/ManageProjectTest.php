<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Project;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageProjectTest extends TestCase
{
    /**
     * @test
     */
    public function only_auth_user_can_view_an_owner()
    {
        $attributes = Project::factory()->raw([]);

        $this->post('/projects',$attributes)->assertRedirect('login');
    }

    /**
     * @test
     */
    public function only_auth_user_can_view_page_create_project()
    {
        $this->get('/projects/create')->assertRedirect('login');
    }

    /**
     * @test
     */

    public function an_auth_user_can_view_projects_from_other()
    {
        $project = Project::factory()->create();

        $this->authUser();
        $this->get($project->path())->assertStatus(403);
    }
}
