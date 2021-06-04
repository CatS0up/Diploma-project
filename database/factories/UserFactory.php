<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'role_id' => 1,
            'address_id' => $this->faker->numberBetween(1, 500),
            'uid' => $this->faker->unique()->userName(),
            'email' => $this->faker->unique()->email(),
            'phone' => $this->faker->unique()->numberBetween(1000000, 99999999),
            'pwd' => $this->faker->password(),
            'description' => $this->faker->text(255)
        ];
    }
}
