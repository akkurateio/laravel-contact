<?php

namespace Akkurate\LaravelContact\Tests;

use Akkurate\LaravelContact\Models\Type;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class AddressApiControllerTest extends TestCase
{
    use WithFaker;
    use WithoutMiddleware;

    /** @test **/
    public function it_should_associate_an_address_to_a_user()
    {
        $response = $this->post(route('api.contact.addresses.store', [
            'uuid' => $this->user->account->uuid,
            'type_id' => Type::factory()->create()->id,
            'name' => $this->user->name,
            'street1' => '48, rue Maurice Béjart',
            'zip' => '34080',
            'city' => 'Montpellier',
            'priority' => 1,
            'is_active' => 1,
            'is_default' => 1,
            'addressable_type' => get_class($this->user),
            'addressable_id' => $this->user->id
        ]));
        $response->assertStatus(201);
    }

    /** @test **/
    public function it_should_associate_an_address_to_an_account()
    {
        $account = $this->user->account;
        
        $response = $this->post(route('api.contact.addresses.store', [
            'uuid' => $this->user->account->uuid,
            'type_id' => Type::factory()->create()->id,
            'name' => $account->name,
            'street1' => '48, rue Maurice Béjart',
            'zip' => '34080',
            'city' => 'Montpellier',
            'priority' => 1,
            'is_active' => 1,
            'is_default' => 1,
            'addressable_type' => get_class($account),
            'addressable_id' => $account->id
        ]));
        $response->assertStatus(201);
    }
}
