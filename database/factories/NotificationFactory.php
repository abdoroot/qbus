<?php

namespace Database\Factories;

use App\Models\Notification;
use Illuminate\Database\Eloquent\Factories\Factory;

class NotificationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Notification::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word,
        'text' => $this->faker->text,
        'url' => $this->faker->word,
        'icon' => $this->faker->word,
        'type' => $this->faker->randomElement(['info', 'success', 'warning', 'danger']),
        'to' => $this->faker->randomElement(['admin']),
        'admin_id' => $this->faker->word,
        'user_id' => $this->faker->word,
        'read_at' => $this->faker->date('Y-m-d H:i:s'),
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
