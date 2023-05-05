<?php

namespace Database\Seeders;

use Eduka\Cube\Models\Chapter;
use Eduka\Cube\Models\Course;
use Eduka\Cube\Models\Domain;
use Eduka\Cube\Models\Video;
use Eduka\Database\Seeders\InitialSchemaSeeder;
use Illuminate\Database\Seeder;

class MasteringNovaCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if the course exists or not. The InitialSchemaSeeder should create the course during migration by default.
        $course = Course::where('name', 'Mastering Nova')->first();

        if (! $course) {
            $course = Course::factory()->count(1)->create();

            Domain::factory()->count(1)->create([
                'suffix' => 'masteringnova.local',
                'course_id' => $course->id,
            ]);
        }

        // Next we create the chapters for that course.
        // Each chapter has videos associated with it.
        // We are randomly creating 5 to 10 videos per chapter.
        $chapters = Chapter::factory()
            ->count(5)
            ->has(Video::factory()->count(fake()->numberBetween(5, 10)))
            ->create(['course_id' => $course->id]);
    }
}
