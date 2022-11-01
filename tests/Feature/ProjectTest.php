<?php

namespace Tests\Feature;
use Tests\TestCase;
use App\Models\User;
use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
class ProjectTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function projectData()
    {
        return [
            'title' => $this->faker->name(),
            'description' => $this->faker->sentence(),
        ];
    }
    /**
     * @test
     */
    public function only_auth_user_can_create_project()
    {
        $this->authUser();

        $data = $this->projectData();

        $this->get('/projects/create')->assertStatus(200);
        $this->post('/projects', $data)->assertRedirect('/projects');
        $this->assertDatabaseHas('projects', $data);
        $this->get('/projects')->assertSee($data['title']);

    }

    /**
    * @test
    */
    public function guest_can_not_create_project()
    {

        $project = Project::factory()->make();

        $this->get('/projects')->assertRedirect('login');
        $this->post($project->path())->assertRedirect('login');
        $this->post('/projects', $project->toArray())->assertRedirect('login');
    }

    /**
     * @test
     */
    public function a_project_require_a_title()
    {
        $attributes = Project::factory()->raw(['title' => '']);

        $this->authUser();
        $this->post('/projects',$attributes)->assertSessionHasErrors('title');
    }

    /**
     * @test
     */
    public function a_project_require_a_description()
    {
        $this->authUser();
        $attributes = Project::factory()->raw(['description' => '']);
        $this->post('/projects',$attributes)->assertSessionHasErrors('description');
    }

    /**
     * @test
     */
    public function only_auth_user_can_view_a_project()
    {
        $this->authUser();
        $data = $this->projectData();
        $this->post('/projects', $data)->assertRedirect('/projects');
        $this->assertDatabaseHas('projects', $data);
        $this->get('/projects')->assertSee($data['title']);
    }

}
