<?php

namespace MasteringNova\Database\Factories;

use Eduka\Cube\Models\Course;
use Eduka\Cube\Models\Domain;
use Illuminate\Database\Eloquent\Factories\Factory;

class DomainFactory extends Factory
{
    protected $model = Domain::class;

    /**
     * Define the model's default state.
     *
     * This is the default behaviour. To enable a domain for a specific course,
     * pass parameters in create() method.
     *
     * Example: Domain::factory()->create(['suffix' => $suffix, 'course_id' => $course->id])
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'suffix' => $this->faker->domainName,
            'course_id' => Course::factory(),
        ];
    }
}
