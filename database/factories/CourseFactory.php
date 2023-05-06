<?php

namespace MasteringNova\Database\Factories;

use Eduka\Cube\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    protected $model = Course::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Mastering Nova',
            'admin_name' => 'Bruno',
            'admin_email' => 'bruno@masteringnova.com',
            'twitter_handle' => 'brunocfalcao',
            'provider_namespace' => 'MasteringNova\\MasteringNovaServiceProvider',
        ];
    }
}
