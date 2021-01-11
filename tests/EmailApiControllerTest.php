<?php

namespace Akkurate\LaravelContact\Tests;

use Akkurate\LaravelContact\Models\Type;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class EmailApiControllerTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;
    use WithoutMiddleware;

    /** @test **/
	public function it_should_associate_an_email_to_a_user()
	{
        $response = $this->post(route('api.contact.emails.store', [
            'uuid' => $this->user->account->uuid,
            'type_id' => Type::factory()->create()->id,
            'name' => $this->user->name,
            'email' => 'email@home.test',
            'priority' => 1,
            'is_active' => 1,
            'is_default' => 1,
            'emailable_type' => get_class($this->user),
            'emailable_id' => $this->user->id
        ]));
        $response->assertStatus(302);
	}

    /** @test **/
	public function it_should_associate_an_email_to_an_account()
	{
        $account = $this->user->account;
        $response = $this->post(route('api.contact.emails.store', [
            'uuid' => $this->user->account->uuid,
            'type_id' => Type::factory()->create()->id,
            'name' => $account->name,
            'email' => 'email@work.test',
            'priority' => 1,
            'is_active' => 1,
            'is_default' => 1,
            'emailable_type' => get_class($account),
            'emailable_id' => $account->id
        ]));
        $response->assertStatus(302);
	}

}
