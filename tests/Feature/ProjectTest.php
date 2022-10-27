<?php

namespace Tests\Feature;
use Tests\TestCase;
use App\Models\User;
use App\Models\Project;
use Illuminate\Http\ResponseTrait;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
        $this->post('/projects', $data)->assertRedirect('/projects');
        $this->assertDatabaseHas('projects', $data);
        $this->get('/projects')->assertSee($data['title']);

    }

    /**
    * @test
    */
    public function guest_can_not_create_project()
    {
        $project = Project::factory()->raw();
        
        $this->post('/projects', $project)->assertRedirect('login');
    }

    /**
    * @test
    */
    public function guest_can_not_view_a_single_project()
    {
        $project = Project::factory()->make();

        $this->post($project->path())->assertRedirect('login');
    }

    /**
     * @test
     */
    public function guest_may_not_view_projects()
    {
        $this->get('/projects')->assertRedirect('login');
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
        $attributes = Project::factory()->raw(['id_owner' => null]);

        $this->be($this->user);
        $this->post('/projects',$attributes)->assertSessionHasErrors('id_owner');
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
