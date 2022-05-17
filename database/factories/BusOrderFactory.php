<?php

namespace Database\Factories;

use App\Models\BusOrder;
use Illuminate\Database\Eloquent\Factories\Factory;

class BusOrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BusOrder::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'date' => $this->faker->word,
        'time' => $this->faker->word,
        'lat' => $this->faker->word,
        'lng' => $this->faker->word,
        'zoom' => $this->faker->randomDigitNotNull,
        'user_id' => $this->faker->word,
        'provider_id' => $this->faker->word,
        'bus_id' => $this->faker->word,
        'fees' => $this->faker->word,
        'status' => $this->faker->randomElement(]),
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
