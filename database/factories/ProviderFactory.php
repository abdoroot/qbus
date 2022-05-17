<?php

namespace Database\Factories;

use App\Models\Provider;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProviderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Provider::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
        'email' => $this->faker->word,
        'phone' => $this->faker->word,
        'password' => $this->faker->word,
        'image' => $this->faker->word,
        'notes' => $this->faker->text,
        'block' => $this->faker->word,
        'block_notes' => $this->faker->text,
        'email_verified_at' => $this->faker->date('Y-m-d H:i:s'),
        'phone_verified_at' => $this->faker->date('Y-m-d H:i:s'),
        'remember_token' => $this->faker->word,
        'approve' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
