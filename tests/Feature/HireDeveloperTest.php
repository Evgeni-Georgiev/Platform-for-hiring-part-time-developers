<?php

namespace Tests\Feature;

use App\Models\Developer;
use App\Models\Hire;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HireDeveloperTest extends TestCase
{
    use RefreshDatabase;

    private $developers;
    private $user;
    private $validHire;
    private $invalidHire;

    protected function setUp(): void
    {
        parent::setUp();

        $this->developers = Developer::factory(3)->create();
        $this->user = User::factory()->create();
        $this->validHire = Hire::factory()->make([
            'id' => 1,
            'ids' => [1],
            'start_date' => today(),
            'end_date' => strtotime('+1 Week', today()->getTimestamp())
        ]);
        $this->invalidHire = Hire::factory()->make([
            'id' => 2,
            'ids' => [1],
            'start_date' => today(),
            'end_date' => strtotime('-1 Week', today()->getTimestamp())
        ]);
    }

    public function test_hire_developer_load_page()
    {
        $response = $this->actingAs($this->user)->get('/hire');
        $response->assertViewHas('list_developers_for_hire', $this->developers);
        $response->assertSee(['Names', 'Profile Picture', 'Start Date', 'End Date', 'Delete']);
        $response->assertStatus(200);
    }

    public function test_hire_developer_valid_date_range()
    {

        $response = $this->actingAs($this->user)->post('/hire', $this->validHire->toArray());
        $response->assertStatus(302);
        $response->assertRedirectContains('/hire');
        $response->assertSessionHasNoErrors();
        $this->assertModelExists($this->validHire);
    }

    public function test_hire_developer_invalid_date_range()
    {

        $response = $this->actingAs($this->user)->post('/hire', $this->invalidHire->toArray());
        $response->assertStatus(302);
        $response->assertSessionHasErrors();
        $this->assertModelMissing($this->invalidHire);
    }

    public function test_hire_developer_already_hired_for_period()
    {
        $response = $this->actingAs($this->user)->post('/hire', $this->validHire->toArray());
        $response->assertStatus(302);
        $response->assertSessionHasNoErrors();
        $this->assertModelExists($this->validHire);

        $response = $this->actingAs($this->user)->post('/hire', $this->validHire->toArray());
        $response->assertStatus(302);
        $response->assertSessionHasErrors();
    }

    public function test_hire_developer_already_hired_for_period_overlap()
    {
        $response = $this->actingAs($this->user)->post('/hire', $this->validHire->toArray());
        $response->assertStatus(302);
        $response->assertSessionHasNoErrors();
        $this->assertModelExists($this->validHire);

        $invalid_hire_overlap = Hire::factory()->make(
            [
                'id' => 2,
                'ids' => [1],
                'start_date' => strtotime('+1 Day', today()->getTimestamp()),
                'end_date' => strtotime('+3 Days', today()->getTimestamp())
            ]
        );

        $response = $this->actingAs($this->user)->post('/hire', $invalid_hire_overlap->toArray());
        $response->assertStatus(302);
        $response->assertSessionHasErrors();
    }

    public function test_delete_hire_success_when_valid_id_provided()
    {
        Developer::factory(2)->create();
        $hire = Hire::factory()->create(['user_hired_id' => $this->user->id]);

        $response = $this->actingAs($this->user)->delete("/hire/delete/$hire->id");

        $response->assertStatus(302);
        $response->assertRedirect('/hire');
    }

    public function test_delete_hire_fails_when_invalid_id_provided()
    {
        Developer::factory(2)->create();
        $hire = Hire::factory()->make(['user_hired_id' => $this->user->id]);

        $response = $this->actingAs($this->user)->delete("/hire/delete/$hire->id");

        $response->assertStatus(404);
    }
}
