<?php

use Eduka\Cube\Models\Course;

/**
 * Returns the Course instance.
 *
 * @return \Eduka\Models\Course
 */
function course()
{
    return (new Course())->first();
}
