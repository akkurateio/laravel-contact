<?php

namespace Akkurate\LaravelContact\Tests;

use Akkurate\LaravelContact\Models\Type;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class EmailControllerTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    /** @test **/
    public function it_should_associate_an_email_to_a_user()
    {
        $this->user->emails()->create([
            'type_id' => Type::factory()->create()->id,
            'email' => 'email@home.fr',
            'priority' => 1,
            'is_active' => 1,
            'is_default' => 1,
        ]);
        $this->assertEquals($this->user->emails()->count(), 1);
    }

    /** @test **/
    public function it_should_associate_an_email_to_an_account()
    {
        $this->user->account->emails()->create([
            'type_id' => Type::factory()->create()->id,
            'email' => 'email@work.fr',
            'priority' => 1,
            'is_active' => 1,
            'is_default' => 1,
        ]);
        $this->assertEquals($this->user->account->emails()->count(), 1);
    }
}
