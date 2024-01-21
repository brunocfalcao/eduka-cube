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
        'custom_data' => ['nullable'],
        'event_name' => ['nullable', 'string'],
        'store_id' => ['nullable', 'string'],
        'customer_id' => ['nullable', 'string'],
        'order_number' => ['nullable', 'string'],
        'user_name' => ['nullable', 'string'],
        'user_email' => ['nullable', 'string'],
        'subtotal_usd' => ['nullable', 'string'],
        'discount_total_usd' => ['nullable', 'string'],
        'tax_usd' => ['nullable', 'string'],
        'total_usd' => ['nullable', 'string'],
        'tax_name' => ['nullable', 'string'],
        'status' => ['nullable', 'string'],
        'refunded' => ['nullable', 'boolean'],
        'refunded_at' => ['nullable', 'string'],
        'order_id' => ['nullable', 'string'],
        'lemon_squeezy_product_id' => ['required', 'string'],
        'lemon_squeezy_variant_id' => ['required', 'string'],
        'lemon_squeezy_product_name' => ['required', 'string'],
        'lemon_squeezy_variant_name' => ['required', 'string'],
        'price' => ['required', 'string'],
        'receipt' => ['nullable', 'string'],
    ];

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
