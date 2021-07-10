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
            'meta' => [
                'twitter:site' => '@brunocfalcao',
                'twitter:description' => 'add-your-course-description',
                'twitter:creator' => '@brunocfalcao'
            ]
        ]);

        /**
        <!-- Social media -->
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:site" content="@brunocfalcao" />
        <meta name="twitter:title" content="Nova Advanced UI" />
        <meta name="twitter:description" content="Nova training course in advanced User Interface development" />
        <meta name="twitter:image" content="https://tailwindui.com/img/og-image.png" />
        <meta name="twitter:creator" content="@brunocfalcao" />
        <meta property="og:url" content="https://www.tailwindui.com/" />
        <meta property="og:type" content="article" />
        <meta property="og:title" content="Tailwind UI" />
        <meta property="og:description" content="Beautiful UI components by the creators of Tailwind CSS." />
        <meta property="og:image" content="https://tailwindui.com/img/og-image.png" />
        <meta property="description" content="Beautiful UI components by the creators of Tailwind CSS." />
        <!-- /Social media -->
         */
    }
}
