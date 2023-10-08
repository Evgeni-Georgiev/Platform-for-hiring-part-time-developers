<?php

namespace Tests\Unit;

use App\Models\Developer;
use Illuminate\Foundation\Testing\TestResponse;
use Tests\TestCase;

class DeveloperTest extends TestCase
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

//    public function test_if_seeders_works() {
//        $this->seed(); // seed all seeders in the seeders folder
//        // Similar:: php artisan db:seed
//
//        $this->assertTrue(true);
//    }

    public function test_get_developers()
    {
        $response = $this->call('GET', '/developers');
        $response->assertStatus(200);
    }

    // HTTP testing
    public function test_create_new_developer()
    {
        $response = $this->post('/developers/create_dev', [
            'id' => 1,
            'name' => 'Jane Doe',
            'email' => 'janedoe@gmail.com',
            'phone' => 1234567895,
            'location' => 'Denver',
            'profile_picture' => 'qqiHOhJsAxePHOJ3ZNPeIE6PwXmg6hlGfNKnoodS.jpg',
            'price_per_hour' => 3,
            'technology' => 'PHP',
            'description' => 'Quaerat alias porro inventore. Accusamus quia voluptatem molestiae dolorum omnis. Qui sequi sit aliquam corrupti quibusdam. Enim cupiditate asperiores est eius labore est.',
            'years_of_experience' => 2,
            'native_language' => 'Bulgarian',
            'linkedin_profile_link' => 'http://www.bradtke.net/harum-dolore-eos-tempore-voluptatum',
        ]);

        $response->assertRedirect('/');
    }

    public function test_developer_duplicate()
    {
        $developer1 = Developer::create([
            'name' => 'Rinzler',
            'email' => 'rinzler@gmail.com'
        ]);

        $developer2 = Developer::create([
            'name' => 'Tron',
            'email' => 'tron@gmail.com'
        ]);

        $this->assertTrue($developer1->name != $developer2->name);
        $this->assertTrue($developer1->email != $developer2->email);

        if (($developer1->name != $developer2->name) && ($developer1->email != $developer2->email)) {
            $developer1->delete();
            $developer2->delete();
        }
    }

    public function test_create_developer()
    {
        if (!Developer::where('email', 'janedoe@gmail.com')->exists()) {
            Developer::factory()->create(['id' => 6, 'name' => "Jane Doe", 'email' => "janedoe@gmail.com"]);
        } else {
            return;
        }
        $this->assertTrue(true);
    }

    public function test_update_developer()
    {
        $developer = Developer::where('name', 'Jane Doe')->first();
        $response = $this->call('PUT', "/developers/update/{$developer->id}", ['name' => 'Flynn', 'email' => "flynn@gmail.com"]);
        $response->assertRedirect('/developers');
    }

    public function test_database()
    {
        $this->assertDatabaseHas('developers', [
            'name' => 'Flynn'
        ]);
    }

    // API Testing
    public function test_get_api_developer()
    {
        $response = $this->getJson('/api/developers');
        $response->assertStatus(405);
    }

    public function test_create_api_developer()
    {
        $developer = Developer::factory()->create([
            'id' => 2,
            'name' => 'Quora'
        ]);
        $response = $this->postJson('/api/developers', $developer->toArray());
        $response->assertStatus(422);
//        $this->assertDatabaseHas('developers', developer);
    }

    public function test_update_api_developer()
    {
        $developer = Developer::where('name', 'Quora')->first();
        $update_data = ['name' => 'Quora1'];
        $response = $this->putJson("/api/developers/edit/{$developer->id}", $update_data);
        $response->assertStatus(200)->assertJson(['message' => 'Developer updated successfully']);
        $this->assertDatabaseHas('developers', $update_data);
    }
}
