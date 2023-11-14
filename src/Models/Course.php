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
        return $this->belongsToMany(User::class, 'course_user');
    }

    public function domains()
    {
        return $this->hasMany(Domain::class);
    }

    public function visits()
    {
        return $this->hasMany(Visit::class);
    }

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }

    public function paymentProviderVariantId(): string
    {
        return $this->payment_provider_variant_id;
    }

    public function paymentProviderStoreId(): string
    {
        return $this->payment_provider_store_id;
    }

    public function priceInCents(): int
    {
        if (! $this->course_price) {
            throw new Exception('product price not set');
        }

        return (int) ($this->course_price * 100);
    }

    public function purchasePowerParityIsEnabled(): bool
    {
        return $this->enable_purchase_power_parity;
    }

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory(): Factory
    {
        return CourseFactory::new();
    }
}
