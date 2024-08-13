<?php

namespace Eduka\Cube\Models;

use Brunocfalcao\LaravelHelpers\Traits\ForModels\HasCanonicals;
use Brunocfalcao\LaravelHelpers\Traits\ForModels\HasCustomQueryBuilder;
use Brunocfalcao\LaravelHelpers\Traits\ForModels\HasUuids;
use Brunocfalcao\LaravelHelpers\Traits\ForModels\HasValidations;
use Eduka\Abstracts\Classes\EdukaModel;
use Eduka\Cube\Concerns\VariantFeatures;
use Illuminate\Validation\Rule;

class Variant extends EdukaModel
{
    use HasCanonicals,
        HasCustomQueryBuilder,
        HasUuids,
        HasValidations,
        VariantFeatures;

    protected $with = ['course'];

    protected $casts = [
        'is_default' => 'boolean',

        'price_override' => 'integer',

        'lemon_squeezy_data' => 'array',
    ];

    public $rules = [
        'description' => ['nullable'],
        'product_id' => ['required', 'string'],
        'price_override' => ['nullable', 'numeric'],
        'is_default' => ['boolean'],
    ];

    public function getRules()
    {
        return [
            'name' => ['required', Rule::unique('variants')->ignore($this->id)],
            'canonical' => ['required', Rule::unique('variants')->ignore($this->id)],
        ];
    }

    // Relationship registered.
    public function students()
    {
        return $this->belongsToMany(Student::class)
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
