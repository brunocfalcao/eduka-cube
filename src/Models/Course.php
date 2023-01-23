<?php

namespace Eduka\Cube\Models;

use Eduka\Analytics\Models\Visit;
use Eduka\Services\Concerns\CourseFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Course extends Model
{
    use Notifiable;
    use CourseFeatures;
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'is_decommissioned' => 'boolean',
        'launched_at' => 'datetime',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function domains()
    {
        return $this->hasMany(Domain::class);
    }

    public function visits()
    {
        return $this->hasMany(Visit::class);
    }
}
