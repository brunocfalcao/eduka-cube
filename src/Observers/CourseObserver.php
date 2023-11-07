<?php

namespace Eduka\Cube\Observers;

use Eduka\Cube\Events\Courses\CourseSaved;
use Eduka\Cube\Models\Course;

class CourseObserver
{
    public function saving(Course $course)
    {
        //
    }

    public function saved(Course $course)
    {
        // Call "CourseSaved" notification event if allowed.
        allow_if(
            config('eduka.stop_notifications') !== true,
            function () use ($course) {
                CourseSaved::dispatch($course);
            }
        );
    }

    public function created(Course $course)
    {
        //
    }

    public function updated(Course $course)
    {
        //
    }

    public function deleted(Course $course)
    {
        //
    }

    public function restored(Course $course)
    {
        //
    }

    public function forceDeleted(Course $course)
    {
        //
    }
}
