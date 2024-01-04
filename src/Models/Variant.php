<?php

namespace Eduka\Cube\Models;

use Brunocfalcao\LaravelHelpers\Traits\HasCustomQueryBuilder;
use Eduka\Abstracts\Classes\EdukaModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Variant extends EdukaModel
{
    use HasCustomQueryBuilder, SoftDeletes;

    protected $casts = [
        'is_default' => 'boolean',

        'lemon_squeezy_price_override' => 'numeric',
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
