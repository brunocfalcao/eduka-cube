<?php

namespace Eduka\Cube\Actions\Coupon;

use Eduka\Cube\Models\Coupon;

class FindCoupon
{
    public static function fromCountryRecord(string $countryIsoCode, int $courseId)
    {
        return Coupon::where('country_iso_code', $countryIsoCode)
            ->where('course_id', $courseId)
            ->first();
    }
}
