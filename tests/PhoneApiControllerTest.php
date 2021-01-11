<?php

namespace Akkurate\LaravelContact\Tests;

use Akkurate\LaravelContact\Models\Type;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class PhoneApiControllerTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;
    use WithoutMiddleware;

	/** @test **/
	public function it_should_associate_a_phone_to_a_user()
	{
        $response = $this->post(route('api.contact.phones.store', [
            'uuid' => $this->user->account->uuid,
            'type_id' => Type::factory()->create()->id,
            'name' => $this->user->name,
            'number' => '0623456789',
            'prefix' => '+33',
            'priority' => 1,
            'is_active' => 1,
            'is_default' => 1,
            'phoneable_type' => get_class($this->user),
            'phoneable_id' => $this->user->id
        ]));
        $response->assertStatus(201);
	}

}
