<?php

namespace Tests\Feature;

use App\Models\Developer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateDeveloperTest extends TestCase
{
    use RefreshDatabase;

    private $developer;
    private $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->developer = Developer::factory()->make();
        $this->user = User::factory()->create();
    }

    public function test_inaccessible_when_not_authenticated()
    {
        $response = $this->get('developers/edit/2');
        $response->assertRedirect('/login');
    }

    public function test_form_loads_when_valid_developer_id_provided()
    {
        $developer = Developer::factory()->create();
        $response = $this->actingAs($this->user)->get("/developers/edit/$developer->id");

        $response->assertStatus(200);
        $response->assertSee(['Edit data', 'Edit Developer name', 'Edit Phone', 'Edit Location', 'Edit Profile Picture', 'Edit Price Per Hour', 'Edit Technology']);
        $response->assertViewHas('developers', $developer);
    }

    public function test_form_fails_when_invalid_developer_id_provided()
    {
        $developer = Developer::factory()->make();
        $response = $this->actingAs($this->user)->get("/developers/edit/$developer->id");

        $response->assertStatus(404);
        $response->assertDontSee(['Edit data', 'Edit Developer name', 'Edit Phone', 'Edit Location', 'Edit Profile Picture', 'Edit Price Per Hour', 'Edit Technology']);
    }

    public function test_update_developer_success_when_valid_data()
    {
        $developer = Developer::factory()->create();
        $developer->name = "New Fake Name";
        $developer->phone = "1234567890";
        $developer->email = "fake_email@mail.fake";
        $response = $this->actingAs($this->user)->put("/developers/update/$developer->id", $developer->toArray());

        $response->assertStatus(302);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect('/developers');
        $this->assertModelExists($developer);
    }

    public function test_update_developer_fails_when_invalid_data()
    {
        $developer = Developer::factory()->create();
        $developer->name = "";
        $developer->phone = "123670";
        $developer->email = "fake@fail.fake";

        $response = $this->actingAs($this->user)->put("/developers/update/$developer->id", $developer->toArray());

        $response->assertStatus(302);
        $response->assertSessionHasErrors();
        $this->assertDatabaseMissing(Developer::class, $developer->toArray());
    }
}
