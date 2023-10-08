<?php

namespace Tests\Unit;

use App\Models\Developer;
use App\Models\Hire;
use Illuminate\Foundation\Testing\TestResponse;
use Tests\TestCase;

class HireTest extends TestCase
{

    public function test_get_hires()
    {
        $response = $this->call('GET', 'hire');
        $response->assertStatus(200);
    }

    // HTTP testing
    public function test_create_new_hires()
    {
        $developer_name = Developer::where('name', 'Flynn')->first();
        $startingDate = now();
        $endingDate = strtotime('+1 Week', $startingDate->getTimestamp());

        $response = $this->post('/hire', [
            'developer_id' => $developer_name->id,
            'names' => $developer_name,
            'start_date' => $startingDate,
            'end_date' => $endingDate
        ]);

        $response->assertRedirect('/');
    }

    public function test_create_hires()
    {
        $developer_name = Developer::where('name', 'Flynn')->first();
        $startingDate = now();
        $endingDate = strtotime('+1 Week', $startingDate->getTimestamp());
        Hire::factory()->create([
            'developer_id' => $developer_name->id,
            'names' => $developer_name,
            'start_date' => $startingDate,
            'end_date' => $endingDate
        ]);
        $this->assertTrue(true);
    }


    // API Testing
    public function test_get_api_hired_developer()
    {
        $response = $this->getJson('/api/hire');
        $response->assertStatus(200);
    }

    public function test_create_api_hired_developer()
    {
        $developer_name = Developer::where('name', 'Flynn')->first();
        $startingDate = now();
        $endingDate = strtotime('+1 Week', $startingDate->getTimestamp());
        $hired_developer = Hire::factory()->create([
            'developer_id' => $developer_name->id,
            'names' => $developer_name,
            'start_date' => $startingDate,
            'end_date' => $endingDate
        ]);
        $hired_developer_to_array = $hired_developer->toArray();
        $response = $this->postJson('/api/hire', $hired_developer_to_array);
        $response->assertStatus(200);
    }


    public function test_delete_developer()
    {
        $developer = Developer::where('name', 'Flynn')->first();
        $response = $this->call('DELETE', "/developers/delete/{$developer->id}");
        $response->assertRedirect('/developers');
    }

    public function test_delete_api_developer()
    {
        $deleteDeveloper = Developer::where('name', 'Quora1')->first();
        $response = $this->deleteJson("/api/developers/delete/{$deleteDeveloper->id}");
        $response->assertStatus(200)->assertJson([]);
    }

}
