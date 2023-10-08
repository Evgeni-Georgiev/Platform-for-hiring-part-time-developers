<?php

namespace Tests\Unit;

use App\Models\Developer;
use App\Models\Hire;
use Illuminate\Foundation\Testing\TestResponse;
use Tests\TestCase;

class HireTest extends TestCase
{

    protected function setUp(): void
    {
        $this->markTestSkipped('Must be revisited.');
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }

    public function test_get_hires()
    {
        $response = $this->call('GET', 'hire');
        $response->assertStatus(200);
    }

    // HTTP testing
    public function test_create_new_hires()
    {
        $developer = Developer::find(6);
        $developer_id = Developer::where('id', $developer->id)->value('id');
        $developer_name = Developer::where('name', $developer->name)->value('name');
        $startingDate = now();
        $endingDate = strtotime('+1 Week', $startingDate->getTimestamp());

        $response = $this->post('/hire', [
            'developer_id' => $developer_id,
            'names' => $developer_name,
            'start_date' => $startingDate,
            'end_date' => $endingDate
        ]);

        $response->assertRedirect('/');
    }

    public function test_create_hires()
    {
        $developer = Developer::find(6);
        $developer_id = Developer::where('id', $developer->id)->value('id');
        $developer_name = Developer::where('name', $developer->name)->value('name');
        $startingDate = now();
        $endingDate = strtotime('+1 Week', $startingDate->getTimestamp());
        Hire::factory()->create([
            'developer_id' => $developer_id,
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
        $developer = Developer::find(2);
        $developer_id = Developer::where('id', 2)->value('id');
        $developer_name = Developer::where('name', $developer->name)->value('name');
        $startingDate = now();
        $endingDate = strtotime('+1 Week', $startingDate->getTimestamp());
        $hired_developer = Hire::factory()->create([
            'developer_id' => $developer_id,
            'names' => $developer_name,
            'start_date' => $startingDate,
            'end_date' => $endingDate
        ]);
        $hired_developer_to_array = $hired_developer->toArray();
        $response = $this->postJson('/api/hire', $hired_developer_to_array);
        $response->assertStatus(200);
//        $this->assertDatabaseHas('developers', $attributes);
    }

}
