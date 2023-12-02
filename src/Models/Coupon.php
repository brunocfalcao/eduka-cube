<?php

namespace Eduka\Cube\Models;

use Eduka\Cube\Abstracts\EdukaModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends EdukaModel
{
    use SoftDeletes;

    public const DEFAULT_NEW_COUPON_CREATION_TEMPLATE = 'ILOVE%COUNTRY_NAME';

    protected $casts = [
        'discount_amount' => 'decimal',
        'is_flat_discount' => 'boolean',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function getLemonSqueezyCouponId()
    {
        return $this->remote_reference_id;
    }

    public function hasRemoteReference()
    {
        return $this->remote_reference_id !== null && $this->remote_reference_id !== '';
    }

    public function generateCodeForCountry(string $countryName, string $countryIso): string
    {
        $template = $this->coupon_code_template;

        if (! $template) {
            $template = self::DEFAULT_NEW_COUPON_CREATION_TEMPLATE;
        }

        $substiationMap = [
            '%ISO_CODE' => $countryIso,
            '%COUNTRY_NAME' => $countryName,
        ];

        $str = strtr($template, $substiationMap);

        $cleanedString = preg_replace('/[^a-zA-Z0-9\s]/', ' ', $str);
        $cleanedString = preg_replace('/\s+/', '', $cleanedString);

        return strtoupper($cleanedString);
    }
}
