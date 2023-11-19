<?php

namespace Eduka\Cube\Commands;

use Eduka\Cube\Models\Coupon;
use Eduka\Cube\Models\Course;
use Eduka\Cube\Util\Country;
use Illuminate\Console\Command;

class CreateCoupons extends Command
{
    protected $signature = 'eduka-cube:create-coupons
                            {--discount-amount= : Number, discount amount}
                            {--is-flat-discount= : Boolean, if the discount is flat or not}
                            {--course-id= : The course ID}';

    protected $description = 'Create coupons for all countries.';

    // php artisan eduka-cube:create-coupons --course-id=2 --discount-amount=25 --is-flat-discount=true
    public function handle()
    {
        $courseId = $this->option('course-id');

        // ensure course exists
        if(! Course::find($courseId)) {
            $this->error("Course not found");

            return 1;
        }

        $discountAmount = (float) $this->option('discount-amount');
        $isFlatDiscount = $this->option('is-flat-discount') === 'true';

        $data = [];

        $coupon = new Coupon();

        foreach (Country::list() as $iso => $countryName) {
            $data[] = [
                'code' => $coupon->generateCodeForCountry($countryName, $iso),
                'is_flat_discount' => $isFlatDiscount,
                'discount_amount' => $discountAmount,
                'country_iso_code' => strtoupper($iso),
                'course_id' => $courseId,
            ];
        }

        Coupon::insert($data);

        $this->info("Coupons created");
    }

}
