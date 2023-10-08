<?php

namespace Tests\Feature;

use App\Models\Developer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateDeveloperTest extends TestCase
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

    public function test_create_developer_with_valid_data()
    {
        $response = $this->actingAs($this->user)->get('/developers/create');
        $response->assertStatus(200);
        $response->assertSee(['Name of Developer', 'Email of Developer', 'Phone of Developer', 'Location of Developer', 'Profile Picture', 'Price Per Hour', 'Technology']);

        $response = $this->actingAs($this->user)->post('/developers/create_dev', $this->developer->toArray());
        $this->assertModelExists($this->user);
        $response->assertStatus(302);
    }

    public function test_cannot_access_for_without_authentication()
    {
        $response = $this->get('/developers/create');
        $response->assertRedirect('/login');
    }

    public function test_create_developer_error_when_missing_required_fields()
    {
        $developer = Developer::factory()->make([
            'email' => '',
            'phone' => '12345789',
            'name' => '']);
        $response = $this->actingAs($this->user)->post('/developers/create_dev', $developer->toArray());
        $response->assertInvalid(['email', 'phone', 'name']);
        $response->assertStatus(302);
        $this->assertModelMissing($developer);
    }

    public function test_developer_not_created_empty_post()
    {
        $response = $this->actingAs($this->user)->post('/developers/create_dev', array([]));
        $response->assertSessionHasErrors();
        $response->assertStatus(302);
    }

    public function test_delete_developer_success_when_valid_id_provided()
    {
        $developer = Developer::factory()->create();
        $response = $this->actingAs($this->user)->delete("/developers/delete/$developer->id");

        $response->assertStatus(302);
        $response->assertRedirect('/developers');
    }

    public function test_delete_developer_fails_when_invalid_id_provided()
    {
        $developer = Developer::factory()->make();
        $response = $this->actingAs($this->user)->delete("/developers/delete/$developer->id");

        $response->assertStatus(404);
    }
}
