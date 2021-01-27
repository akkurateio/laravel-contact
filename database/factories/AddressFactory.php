<?php

namespace Akkurate\LaravelContact\Database\Factories;

use Akkurate\LaravelContact\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Address::class;

    public function definition()
    {
        return [
            'street1' => $this->faker->streetAddress,
            'postcode' => $this->faker->postcode,
            'city' => $this->faker->city,
            'addressable_type' => 'App\Models\User',
            'addressable_id' => 1,
            'department_id' => $this->faker->numberBetween(1, 13),
        ];
    }
}
