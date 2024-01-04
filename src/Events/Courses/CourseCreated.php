<?php

namespace Eduka\Cube\Events\Courses;

use Eduka\Cube\Models\Course;
use Eduka\Cube\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CourseCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public array $payload;

    /**
     * Payload:
     * [
     *  'course' => mandatory, Course object
     *  'user'   => optional, in case it's authenticated
     * ]
     */
    public function __construct(array $payload)
    {
        $this->payload = $payload;
    }
}
