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
            'code' => ['required', 'string', 'min:1', 'max:255'],
            'description' => ['required'],
            'discount_amount' => ['required', 'integer', 'min:0', 'max:100'],
            'discount_percentage' => ['required_without:discount_amount', 'required', 'integer', 'min:0', 'max:100'],
            'course_id' => ['required', 'exists:courses,id']
        ]);
    }
}
