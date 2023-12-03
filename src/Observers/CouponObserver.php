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
            'discount_amount' => 'numeric|max:100',
            'discount_percentage' => 'required_without:discount_amount|numeric|max:100',
        ]);
    }
}
