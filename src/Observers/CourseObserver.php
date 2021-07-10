<?php

namespace Eduka\Cube\Observers;

use Eduka\Abstracts\EdukaException;
use Eduka\Cube\Models\Course;

class CourseObserver
{
    /**
     * Handle the Course "saved" event.
     *
     * @param  \Eduka\Models\Course  $course
     * @return void
     */
    public function saved(Course $course)
    {
        //
    }

    /**
     * Handle the Course "created" event.
     *
     * @param  \Eduka\Models\Course  $course
     * @return void
     */
    public function created(Course $course)
    {
        //
    }

    /**
     * Handle the Course "updated" event.
     *
     * @param  \Eduka\Models\Course  $course
     * @return void
     */
    public function updated(Course $course)
    {
        //
    }

    /**
     * Handle the Course "deleted" event.
     *
     * @param  \Eduka\Models\Course  $course
     * @return void
     */
    public function deleting(Course $course)
    {
        throw new EdukaException('A course cannot be deleted');
    }

    /**
     * Handle the Course "deleted" event.
     *
     * @param  \Eduka\Models\Course  $course
     * @return void
     */
    public function deleted(Course $course)
    {
        //
    }

    /**
     * Handle the Course "restored" event.
     *
     * @param  \Eduka\Models\Course  $course
     * @return void
     */
    public function restored(Course $course)
    {
        //
    }

    /**
     * Handle the Course "force deleted" event.
     *
     * @param  \Eduka\Models\Course  $course
     * @return void
     */
    public function forceDeleted(Course $course)
    {
        //
    }
}
