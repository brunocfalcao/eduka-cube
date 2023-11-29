<?php

namespace Eduka\Cube\Actions\Video;

use Eduka\Cube\Models\Course;

class UpdateBackblazeBucketName
{
    public static function update(Course $course, string $bucketName): Course
    {
        $course->update(['backblaze_bucket_name' => $bucketName]);

        $course->fresh();

        return $course;
    }
}
