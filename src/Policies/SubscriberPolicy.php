<?php

namespace Eduka\Cube\Policies;

use Eduka\Cube\Models\Subscriber;
use Eduka\Cube\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubscriberPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Subscriber $model)
    {
        return true;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Subscriber $model)
    {
        return true;
    }

    public function delete(User $user, Subscriber $model)
    {
        return true;
    }

    public function restore(User $user, Subscriber $model)
    {
        return true;
    }

    public function forceDelete(User $user, Subscriber $model)
    {
        return true;
    }
}
