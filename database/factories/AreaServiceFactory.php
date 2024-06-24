<?php

namespace Database\Factories;

use Faker\Core\Number;
use Hamcrest\Type\IsNumeric;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AreaService>
 */
class AreaServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id'=>$this->faker->unique()->randomNumber(),
            'name' => $this->faker->name(),
            

        ];
    }
}
