<?php

namespace Eduka\Cube\Events\Courses;

use Eduka\Cube\Models\Course;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * This event is triggered each time a new domain is saved into the database.
 */
class CourseSaved
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $course;

    public function __construct(Course $course)
    {
        $this->course = $course;
    }
}
