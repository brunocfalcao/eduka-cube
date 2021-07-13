<?php

use Eduka\Cube\Models\Course;
use Illuminate\Support\Facades\Schema;

/**
 * Returns the Course instance.
 *
 * @return \Eduka\Models\Course
 */
function course()
{
    if (Schema::hasTable('course')) {
        return (new Course())->firstOr(function () {

        });
    }

}
