<?php

namespace Eduka\Cube\Events\Subscribers;

use Eduka\Cube\Models\Course;
use Eduka\Cube\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CoursePurchased
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Course $course;
    public User $user;

    public function __construct(Course $course, User $user)
    {
        $this->user = $user;
        $this->course = $course;
    }
}
