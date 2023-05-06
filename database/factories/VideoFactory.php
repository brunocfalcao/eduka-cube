<?php

namespace MasteringNova\Database\Factories;

use Eduka\Cube\Models\Video;
use Illuminate\Database\Eloquent\Factories\Factory;

class VideoFactory extends Factory
{
    protected $model = Video::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->realTextBetween(20, 100),
            'details' => $this->faker->realTextBetween(150, 250),
            'vimeo_id' => $this->faker->numberBetween(1000000, 2000000),
            'duration' => $this->faker->numberBetween(5, 30),
            'uuid' => $this->faker->uuid(),
            'is_visible' => $this->faker->boolean(),
            'is_free' => $this->faker->boolean(),
            'is_active' => $this->faker->boolean(),
        ];
    }
}
