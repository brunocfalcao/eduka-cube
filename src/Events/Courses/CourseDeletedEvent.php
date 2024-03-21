<?php

namespace Eduka\Cube\Events\Courses;

use Eduka\Cube\Models\Course;

class CourseDeletedEvent
{
    public Course $course;

    public function __construct(Course $course)
    {
        $this->course = $course;
    }
}
