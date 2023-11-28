<?php

namespace Eduka\Cube\Actions;

use Eduka\Cube\Models\Course;

class UpdateVimeoProjectId
{
    public static function update(Course $course, string $vimeoProjectId)
    {
        return $course->update([
            'vimeo_project_id' => $vimeoProjectId,
        ]);
    }
}
