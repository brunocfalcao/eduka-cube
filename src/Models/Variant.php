<?php

namespace Eduka\Cube\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Variant extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'is_default' => 'boolean',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function videos()
    {
        return $this->belongsToMany(Video::class)
                    ->withPivot('index')
                    ->withTimestamps();
    }

    public function priceOverrideInCents()
    {
        return (int) $this->lemonsqueezy_price_override * 100;
    }
}
