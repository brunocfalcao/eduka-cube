<?php

namespace Eduka\Cube\Models;

use Eduka\Analytics\Models\Visit;
use Eduka\Services\Concerns\CourseFeatures;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\Factory;
use MasteringNova\Database\Factories\CourseFactory;

class Course extends Model
{
    use Notifiable;
    use CourseFeatures;
    use SoftDeletes;
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'is_decommissioned' => 'boolean',
        'launched_at' => 'datetime',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function domains()
    {
        return $this->hasMany(Domain::class);
    }

    public function visits()
    {
        return $this->hasMany(Visit::class);
    }

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory(): Factory
    {
        return CourseFactory::new();
    }

    public function paymentProviderProductId() : string
    {
        return $this->payment_provider_product_id;
    }

    public function paymentProviderStoreId() : string
    {
        return $this->payment_provider_store_id;
    }

    public function priceInCents() : int
    {
        if(! $this->course_price) {
            throw new Exception('product price not set');
        }

        return (int) ($this->course_price * 100);
    }

    public function purchasePowerParityIsEnabled() : bool
    {
        return $this->enable_purchase_power_parity;
    }
}
