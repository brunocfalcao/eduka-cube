<?php

namespace Eduka\Cube\Models;

use Eduka\Cube\Abstracts\EdukaModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Variant extends EdukaModel
{
    use SoftDeletes;

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
        return (int) $this->lemon_squeezy_price_override * 100;
    }
}
