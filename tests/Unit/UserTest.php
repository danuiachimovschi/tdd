<?php

namespace Tests\Unit;

use App\Models\Project;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
    * @test
    */

    public function has_projects()
{
        $user = User::factory()->make();

       $this->assertInstanceOf(Collection::class, $user->projects);
    }

    /**
     * @test
     */

    public function it_project_belong_to_an_owner()
    {
        $project = Project::factory()->create();

        $this->assertInstanceOf(User::class, $project->owner);
    }
}
