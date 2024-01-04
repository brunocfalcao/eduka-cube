<?php

namespace Eduka\Cube\Models;

use Brunocfalcao\LaravelHelpers\Traits\HasCustomQueryBuilder;
use Eduka\Abstracts\Classes\EdukaModel;
use Eduka\Cube\Concerns\CourseFeatures;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends EdukaModel
{
    use CourseFeatures, HasCustomQueryBuilder, SoftDeletes;

    protected $casts = [
        'prelaunched_at' => 'datetime',
        'launched_at' => 'datetime',
        'retired_at' => 'datetime',

        'is_active' => 'boolean',
        'is_ppp_enabled' => 'boolean',
    ];

    // Relationship registered.
    public function users()
    {
        return $this->belongsToMany(User::class)
                    ->withTimestamps();
    }

    // Relationship registered.
    public function subscribers()
    {
        return $this->hasMany(Subscriber::class);
    }

    // Relationship registered.
    public function adminUser()
    {
        return $this->hasOne(Course::class, 'course_id_as_admin');
    }

    // Relationship registered.
    public function tags()
    {
        return $this->hasMany(Tag::class);
    }

    // Relationship registered.
    public function variants()
    {
        return $this->hasMany(Variant::class);
    }

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
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

    public function getVariantOrDefault(?Variant $variant = null)
    {
        return $variant ?? $this->variants()->firstWhere('is_default', true);
    }

    public function paymentProviderStoreId()
    {
        return $this->lemon_squeezy_store_id;
    }

    public function getDefaultVariant()
    {
        if ($this->variants->count() > 1) {
            return $this->variants->firstWhere('is_default', true);
        } else {
            return $this->variants->first();
        }
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

    public function getCurrentProgress(): int
    {
        return $this->course_completion;
    }
}
