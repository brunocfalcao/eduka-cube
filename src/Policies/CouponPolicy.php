<?php

namespace Eduka\Cube\Policies;

use Eduka\Cube\Models\Coupon;
use Eduka\Cube\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CouponPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Coupon $coupon)
    {
        return true;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Coupon $coupon)
    {
        return true;
    }

    public function delete(User $user, Coupon $coupon)
    {
        return true;
    }

    public function restore(User $user, Coupon $coupon)
    {
        return true;
    }

    public function forceDelete(User $user, Coupon $coupon)
    {
        return true;
    }
}
