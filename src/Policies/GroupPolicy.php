<?php

namespace Eduka\Cube\Policies;

use Eduka\Cube\Models\Group;
use Eduka\Cube\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GroupPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Group $group)
    {
        return true;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Group $group)
    {
        return true;
    }

    public function delete(User $user, Group $group)
    {
        return true;
    }

    public function restore(User $user, Group $group)
    {
        return true;
    }

    public function forceDelete(User $user, Group $group)
    {
        return true;
    }
}
