<?php

namespace Eduka\Cube\Models;

use Brunocfalcao\LaravelHelpers\Traits\HasCustomQueryBuilder;
use Eduka\Abstracts\Classes\EdukaModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends EdukaModel
{
    use HasCustomQueryBuilder, SoftDeletes;

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
        return $this->belongsTo(Variant::class);
    }
}
