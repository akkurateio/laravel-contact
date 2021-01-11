<?php

namespace Akkurate\LaravelContact\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Akkurate\LaravelContact\Models\Type;

class TypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Type::class;

    public function definition()
    {
        return [
            'code' => $this->faker->randomElement(['WORK','HOME','BILLING', 'DELIVERY']),
            'name' => $this->faker->lastName,
            'shortname' => $this->faker->word,
            'description' => $this->faker->word,
            'priority' => $this->faker->randomDigitNotNull,
            'is_active' => $this->faker->boolean,
        ];
    }
}
