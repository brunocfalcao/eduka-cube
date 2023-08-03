<?php

namespace Eduka\Cube\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\Factory;
use MasteringNova\Database\Factories\ChapterFactory;

class Coupon extends Model
{
    use SoftDeletes, HasFactory;

    protected $guarded = [];

    protected $casts = [
        'discount_amount' => 'decimal',
        'is_flat_discount' => 'boolean',
    ];

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
}
