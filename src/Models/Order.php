<?php

namespace Eduka\Cube\Models;

use Brunocfalcao\LaravelHelpers\Traits\HasCustomQueryBuilder;
use Brunocfalcao\LaravelHelpers\Traits\HasValidations;
use Eduka\Abstracts\Classes\EdukaModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends EdukaModel
{
    use HasCustomQueryBuilder,
        HasValidations,
        SoftDeletes;

    protected $casts = [
        'response_body' => 'array',
        'custom_data' => 'array',
    ];

    public $rules = [
        'user_id' => ['nullable', 'exists:users,id'],
        'variant_id' => ['required', 'exists:variants,id'],
        'response_body' => ['required'],
        'custom_data' => ['required'],
        'event_name' => ['required'],
        'store_id' => ['required'],
        'customer_id' => ['required'],
        'order_number' => ['required'],
        'user_name' => ['required'],
        'user_email' => ['required'],
        'subtotal_usd' => ['required'],
        'tax_usd' => ['required'],
        'total_usd' => ['required'],
        'status' => ['required'],
        'refunded' => ['nullable', 'boolean'],
        'order_id' => ['required'],
        'lemon_squeezy_product_id' => ['required'],
        'lemon_squeezy_variant_id' => ['required'],
        'lemon_squeezy_product_name' => ['required'],
        'lemon_squeezy_variant_name' => ['required'],
        'price' => ['required'],
        'receipt' => ['required'],
    ];

    // Relationship registered.
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Relationship registered.
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship registered.
    public function variant()
    {
        return $this->belongsTo(Variant::class);
    }
}
