<?php

namespace Eduka\Cube\Models;

use Brunocfalcao\LaravelHelpers\Traits\HasCustomQueryBuilder;
use Brunocfalcao\LaravelHelpers\Traits\HasValidations;
use Eduka\Abstracts\Classes\EdukaModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Variant extends EdukaModel
{
    use HasCustomQueryBuilder,
        HasValidations,
        SoftDeletes;

    protected $casts = [
        'is_default' => 'boolean',

        'lemon_squeezy_price_override' => 'integer',
    ];

    public $rules = [
        'canonical' => ['required'],
        'description' => ['nullable'],
        'lemon_squeezy_variant_id' => ['nullable', 'string'],
        'lemon_squeezy_price_override' => ['nullable', 'numeric'],
        'is_default' => ['boolean'],
    ];

    // Relationship registered.
    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withTimestamps();
    }

    // Relationship registered.
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Relationship registered.
    public function chapters()
    {
        return $this->belongsToMany(Chapter::class)
            ->withTimestamps();
    }

    // Relationship registered.
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
