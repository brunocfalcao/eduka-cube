<?php

namespace Eduka\Cube\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use SoftDeletes, HasFactory;

    protected $guarded = [];

    protected $casts = [
        'discount_amount' => 'decimal:2',
        'is_flat_discount' => 'boolean',
    ];

    public const DEFUALT_NEW_COUPON_CREATION_TEMPLATE = "ILOVE%COUNTRY_NAME";

    // /**
    //  * Create a new factory instance for the model.
    //  */
    // protected static function newFactory(): Factory
    // {
    //     return ChapterFactory::new();
    // }

    public function getLemonSqueezyCouponId()
    {
        return $this->remote_reference_id;
    }

    public function hasRemoteReference() : bool
    {
        return $this->remote_reference_id !== null && $this->remote_reference_id !== "";
    }

    public function generateCodeForCountry(string $countryName, string $countryIso) : string
    {
        $template = $this->coupon_code_template;

        if(! $template) {
            $template = self::DEFUALT_NEW_COUPON_CREATION_TEMPLATE;
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
