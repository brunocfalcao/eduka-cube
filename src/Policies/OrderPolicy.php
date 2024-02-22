<?php

namespace Eduka\Cube\Policies;

use Eduka\Cube\Models\Order;
use Eduka\Cube\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Order $model)
    {
        return true;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Order $model)
    {
        return true;
    }

    public function delete(User $user, Order $model)
    {
        return $model->canBeDeleted();
    }

    public function restore(User $user, Order $model)
    {
        return $model->trashed();
    }

    public function forceDelete(User $user, Order $model)
    {
        return $model->trashed();
    }

    public function replicate(User $user, Order $model)
    {
        return false;
    }

    public function attachAnyUser(User $user, Order $model)
    {
        info('verifying from order policy');

        return false;
    }
}
