<?php

namespace Akkurate\LaravelContact\Tests;

use Akkurate\LaravelContact\Models\Type;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class PhoneControllerTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    /** @test **/
    public function it_should_associate_a_phone_number_to_a_user()
    {
        $this->user->phones()->create([
            'type_id' => Type::factory()->create()->id,
            'number' => '0612345678',
            'prefix' => '+33',
            'priority' => 1,
            'is_active' => 1,
            'is_default' => 1,
        ]);
        $this->assertEquals($this->user->phones->count(), 1);
    }
}
