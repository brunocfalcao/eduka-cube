<?php

namespace Eduka\Cube\Models;

use Brunocfalcao\LaravelHelpers\Traits\ForModels\HasCustomQueryBuilder;
use Brunocfalcao\LaravelHelpers\Traits\ForModels\HasValidations;
use Eduka\Abstracts\Classes\EdukaModel;

class Order extends EdukaModel
{
    use HasCustomQueryBuilder,
        HasValidations;

    protected $with = ['course', 'student', 'variant'];

    protected $casts = [
        'response_body' => 'array',
        'custom_data' => 'array',

        'refunded' => 'boolean',
    ];

    public $rules = [
        'student_id' => ['nullable', 'exists:users,id'],
        'variant_id' => ['required', 'exists:variants,id'],
        'response_body' => ['required'],
        'custom_data' => ['required'],
        'event_name' => ['required'],
        'store_id' => ['required'],
        'user_email' => ['required'],
        'total_usd' => ['required'],
        'refunded' => ['nullable', 'boolean'],
        'order_id' => ['required'],
        'price' => ['required'],
        'receipt' => ['required'],
    ];

    // Relationship registered.
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Relationship registered.
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    // Relationship registered.
    public function variant()
    {
        return $this->belongsTo(Variant::class);
    }
}
