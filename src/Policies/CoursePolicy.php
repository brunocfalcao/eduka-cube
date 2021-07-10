<?php

namespace Eduka\Cube\Policies;

use Eduka\Cube\Models\Course;
use Eduka\Cube\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CoursePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \Eduka\Cube\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \Eduka\Cube\Models\User  $user
     * @param  \Eduka\Cube\Models\Course  $course
     * @return mixed
     */
    public function view(User $user, Course $course)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \Eduka\Cube\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \Eduka\Cube\Models\User  $user
     * @param  \Eduka\Cube\Models\Course  $course
     * @return mixed
     */
    public function update(User $user, Course $course)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \Eduka\Cube\Models\User  $user
     * @param  \Eduka\Cube\Models\Course  $course
     * @return mixed
     */
    public function delete(User $user, Course $course)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \Eduka\Cube\Models\User  $user
     * @param  \Eduka\Cube\Models\Course  $course
     * @return mixed
     */
    public function restore(User $user, Course $course)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \Eduka\Cube\Models\User  $user
     * @param  \Eduka\Cube\Models\Course  $course
     * @return mixed
     */
    public function forceDelete(User $user, Course $course)
    {
        return false;
    }
}
