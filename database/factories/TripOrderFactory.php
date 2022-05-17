<?php

namespace Database\Factories;

use App\Models\TripOrder;
use Illuminate\Database\Eloquent\Factories\Factory;

class TripOrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TripOrder::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'trip_id' => $this->faker->word,
        'user_id' => $this->faker->word,
        'seat_num' => $this->faker->randomDigitNotNull,
        'count' => $this->faker->randomDigitNotNull,
        'total' => $this->faker->randomDigitNotNull,
        'status' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
