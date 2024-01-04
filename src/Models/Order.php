<?php

namespace Eduka\Cube\Models;

use Eduka\Abstracts\Classes\EdukaModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends EdukaModel
{
    use SoftDeletes;

    protected $casts = [
        'response_body' => 'array',
        'custom_data' => 'array',
    ];

    // Relationship registered.
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship registered.
    public function variant()
    {
        return $this->belongsTo(Variant::class, 'variant_id', 'lemon_squeezy_variant_id');
    }
}
