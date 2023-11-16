<?php

namespace Eduka\Cube\Models;

use Eduka\Services\Concerns\CourseFeatures;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use MasteringNova\Database\Factories\CourseFactory;

class Course extends Model
{
    use CourseFeatures;
    use HasFactory;
    use Notifiable;
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'is_decommissioned' => 'boolean',
        'launched_at' => 'datetime',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'course_user')
                    ->withTimestamps();
    }

    public function domains()
    {
        return $this->hasMany(Domain::class);
    }

    public function visits()
    {
        return $this->hasMany(Visit::class);
    }

    public function variants()
    {
        return $this->hasMany(Variant::class);
    }

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }

    public function priceInCents(): int
    {
        if (! $this->course_price) {
            throw new Exception('product price not set');
        }

        return (int) ($this->course_price * 100);
    }

    /**
     * Returns a variant given an id. If null, returns the default
     * variant instance. UUID because that's what comes normally from
     * a webpage input field.
     */
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

    public function isPPPEnabled(): bool
    {
        return $this->enable_purchase_power_parity == true;
    }

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory(): Factory
    {
        return CourseFactory::new();
    }
}
