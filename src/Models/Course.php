<?php

namespace Eduka\Cube\Models;

use Eduka\Services\Concerns\CourseFeatures;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use MasteringNova\Database\Factories\CourseFactory;

class Course extends Model
{
    use CourseFeatures, Notifiable, SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'is_decommissioned' => 'boolean',
        'launched_at' => 'datetime',
    ];

    public function domains()
    {
        return $this->hasMany(Domain::class);
    }

    public function variants()
    {
        return $this->hasMany(Variant::class);
    }

    public function coupons()
    {
        return $this->hasMany(Coupon::class);
    }

    public function priceInCents()
    {
        if (! $this->course_price) {
            throw new Exception('product price not set');
        }

        return (int) ($this->course_price * 100);
    }

    public function getVariantOrDefault(string $variantUuid = null)
    {
        if (! $variantUuid) {
            return $this->getDefaultVariant();
        }

        return $this->variants->firstWhere('uuid', $variantUuid);
    }

    public function paymentProviderStoreId()
    {
        return $this->lemonsqueezy_store_id;
    }

    public function getDefaultVariant()
    {
        return $this->variants->firstWhere('is_default', true);
    }

    public function isPPPEnabled()
    {
        return $this->enable_purchase_power_parity == true;
    }

    public function createBucketNameUsing()
    {
        return $this->canonical;
    }

    public function getBucketName()
    {
        return $this->backblaze_bucket_name;
    }

    protected static function newFactory()
    {
        return CourseFactory::new();
    }
}
