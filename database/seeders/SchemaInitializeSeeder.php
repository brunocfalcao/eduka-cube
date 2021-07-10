<?php

namespace Eduka\Database\Seeders;

use Eduka\Cube\Models\Course;
use Eduka\Cube\Models\User;
use Illuminate\Database\Seeder;

class SchemaInitializeSeeder extends Seeder
{
    public function run()
    {
        // Create a Course stub.
        Course::create([
            'name' => env('APP_NAME'),
            'meta' => ['twitter:card' => 'summary_large_image']
        ]);
    }
}
