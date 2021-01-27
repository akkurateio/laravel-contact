<?php

namespace Akkurate\LaravelContact\Tests;

use Akkurate\LaravelContact\Models\Type;
use Illuminate\Foundation\Testing\WithFaker;

class AddressControllerTest extends TestCase
{
    use WithFaker;

    /** @test **/
    public function it_should_associate_an_address_to_a_user()
    {
        $this->user->addresses()->create([
            'type_id' => Type::factory()->create()->id,
            'street1' => '48, rue Maurice Béjart',
            'postcode' => '34080',
            'city' => 'Montpellier',
            'priority' => 1,
            'is_active' => 1,
            'is_default' => 1,
        ]);
        $this->assertEquals($this->user->addresses()->first()->city, 'Montpellier');
    }

    /** @test **/
    public function it_should_associate_an_address_to_an_account()
    {
        $this->user->account->addresses()->create([
            'type_id' => Type::factory()->create()->id,
            'street1' => '48, rue Maurice Béjart',
            'postcode' => '34080',
            'city' => 'Montpellier',
            'priority' => 1,
            'is_active' => 1,
            'is_default' => 1,
        ]);
        $this->assertEquals($this->user->account->addresses()->first()->city, 'Montpellier');
    }
}
