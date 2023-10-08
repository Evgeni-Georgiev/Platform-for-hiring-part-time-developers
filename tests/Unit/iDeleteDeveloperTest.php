<?php

namespace Tests\Unit;

use App\Models\Developer;
use App\Models\Hire;
use Tests\TestCase;

class iDeleteDeveloperTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }


    public function test_delete_hired_developer() {
        $developer = Developer::find(2);
        $developer_name = Developer::where('name', $developer->name)->value('name');
        $hired_developer = Hire::where('names', $developer_name)->first();

        $response = $this->call('DELETE', "/hire/delete/{$hired_developer->id}");
        $response->assertRedirect('/hire');
    }

    public function test_delete_api_hired_developer() {
        $hired_developer = Hire::factory()->create();
        $response = $this->deleteJson("/api/hire/delete/{$hired_developer->id}");
        $response->assertStatus(200)->assertJson([]);
    }


    public function test_delete_developer() {
        $developer = Developer::find(6);
        $developer_name = Developer::where('name', $developer->name)->value('name');

        $developer = Developer::where('name', $developer_name)->first();
        $response = $this->call('DELETE', "/developers/delete/{$developer->id}");
        $response->assertRedirect('/developers');
    }

    public function test_delete_api_developer() {
        $developer = Developer::find(2);
        $developer_name = Developer::where('name', $developer->name)->value('name');

        $developer_delete = Developer::where('name', $developer_name)->first();
        $response = $this->deleteJson("/api/developers/delete/{$developer_delete->id}");
        $response->assertStatus(200)->assertJson([]);
    }
}
