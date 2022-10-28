<?php

namespace Tests\Feature;
use Tests\TestCase;
use App\Models\User;
use App\Models\Project;
use Illuminate\Foundation\Testing\WithFaker;
class ProjectTest extends TestCase
{
    use WithFaker;

    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    /**
     * @test
     */
    public function only_auth_user_can_create_project()
    {
        $data = [
            'title' => $this->faker->name(),
            'description' => $this->faker->sentence(),
            'id_owner' => $this->user->id
        ];

        $this->be($this->user);
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

        $this->be($this->user);
        $this->post('/projects',$attributes)->assertSessionHasErrors('title');
    }

    /**
     * @test
     */
    public function a_project_require_a_description()
    {
        $attributes = Project::factory()->raw(['description' => '']);

        $this->be($this->user);
        $this->post('/projects',$attributes)->assertSessionHasErrors('description');
    }

    /**
     * @test
     */
    public function only_auth_user_can_view_a_project()
    {
        $project = Project::factory()->create(['id_owner' => $this->user->id]);

        $this->be($this->user);
        $this->get($project->path())->assertSee($project->title);
    }

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

        $this->be($this->user);
        $this->get($project->path())->assertStatus(403);
    }
}
