<?php

namespace Eduka\Cube\Policies;

use Eduka\Cube\Models\User;
use Eduka\Cube\Models\Visit;
use Illuminate\Auth\Access\HandlesAuthorization;

class VisitPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Visit $visit)
    {
        return true;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Visit $visit)
    {
        return true;
    }

    public function delete(User $user, Visit $visit)
    {
        return true;
    }

    public function restore(User $user, Visit $visit)
    {
        return true;
    }

    public function forceDelete(User $user, Visit $visit)
    {
        return true;
    }
}
