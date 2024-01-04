<?php

namespace Eduka\Cube\Models;

use Brunocfalcao\LaravelHelpers\Traits\HasCustomQueryBuilder;
use Eduka\Abstracts\Classes\EdukaModel;
use Eduka\Cube\Concerns\CourseFeatures;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends EdukaModel
{
    use CourseFeatures, HasCustomQueryBuilder, SoftDeletes;

    protected $casts = [
        'prelaunched_at' => 'datetime',
        'launched_at' => 'datetime',
        'retired_at' => 'datetime',

        'is_active' => 'boolean',
        'is_ppp_enabled' => 'boolean',
    ];

    // Relationship registered.
    public function users()
    {
        return $this->belongsToMany(User::class)
                    ->withTimestamps();
    }

    // Relationship registered.
    public function subscribers()
    {
        return $this->hasMany(Subscriber::class);
    }

    // Relationship registered.
    public function adminUser()
    {
        return $this->hasOne(Course::class, 'course_id_as_admin');
    }

    // Relationship registered.
    public function tags()
    {
        return $this->hasMany(Tag::class);
    }

    // Relationship registered.
    public function variants()
    {
        return $this->hasMany(Variant::class);
    }

    // Relationship registered.
    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }

    public function videos()
    {
        return $this->hasMany(Video::class);
    }
}
