<?php

namespace Eduka\Cube\Models;

use Eduka\Abstracts\EdukaModel;

class ApplicationLog extends EdukaModel
{
    protected $table = 'application_log';

    protected $casts = [
        'parameters' => 'array',
    ];

    /**
     * Get the parent commentable model (post or video).
     */
    public function loggable()
    {
        return $this->morphTo();
    }

    public function causer()
    {
        return $this->belongsTo(User::class);
    }
}
