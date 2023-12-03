<?php

namespace Eduka\Cube\Observers;

use Brunocfalcao\LaravelHelpers\Traits\CanValidateObserverAttributes;
use Eduka\Cube\Models\Coupon;

class CouponObserver
{
    use CanValidateObserverAttributes;

    public function saving(Coupon $coupon)
    {
        $this->validate($coupon, [
            'code' => 'required',
            'description' => 'required',
        ]);
    }
}
