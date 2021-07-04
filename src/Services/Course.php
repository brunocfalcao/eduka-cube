<?php

namespace Eduka\Cube\Services;

class Course
{
    public static function __callStatic($method, $args)
    {
        return CourseService::new()->{$method}(...$args);
    }
}

class CourseService
{
    public function __construct()
    {
        //
    }

    public static function new(...$args)
    {
        return new self(...$args);
    }

    public function active()
    {
        return (bool) config('eduka-nereus.course.active');
    }

    public function launched()
    {
        return $this->active() && $this->launched_at() < now();
    }

    public function launched_at()
    {
        return config('eduka-nereus.course.launched_at');
    }

    public function name()
    {
        return config('eduka-nereus.course.name');
    }
}
