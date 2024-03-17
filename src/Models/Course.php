<?php

namespace Eduka\Cube\Models;

use Brunocfalcao\LaravelHelpers\Traits\HasCustomQueryBuilder;
use Brunocfalcao\LaravelHelpers\Traits\HasValidations;
use Eduka\Abstracts\Classes\EdukaModel;
use Eduka\Cube\Concerns\CourseFeatures;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends EdukaModel
{
    use CourseFeatures,
        HasCustomQueryBuilder,
        HasValidations,
        SoftDeletes;

    protected $casts = [
        'prelaunched_at' => 'datetime',
        'launched_at' => 'datetime',
        'retired_at' => 'datetime',
        'metas' => 'array',

        'is_active' => 'boolean',
        'is_ppp_enabled' => 'boolean',
    ];

    public $rules = [
        'name' => ['required', 'string'],
        'description' => ['required'],
        'canonical' => ['required'],
        'domain' => ['required', 'string'],
        'provider_namespace' => ['nullable', 'string'],
        'is_active' => ['nullable', 'boolean'],
        'is_ppp_enabled' => ['nullable', 'boolean'],
        'lemon_squeezy_store_id' => ['nullable', 'string'],
        'vimeo_uri_key' => ['nullable', 'string'],
        'backblaze_bucket_name' => ['nullable', 'string'],
    ];

    // Computed attributes.
    public $appends = ['metas'];

    // Relationship registered.
    public function backend()
    {
        return $this->belongsTo(Backend::class);
    }

    // Relationship registered.
    public function users()
    {
        return $this->belongsToMany(Student::class)
            ->withTimestamps();
    }

    // Relationship registered.
    public function subscribers()
    {
        return $this->hasMany(Subscriber::class);
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

    // Relationship registered.
    public function series()
    {
        return $this->hasMany(Series::class);
    }

    // Relationship registered.
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // Relationship registered.
    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }

    public function canBeDeleted()
    {
        // No active episodes part of this chapter.
        return ! $this->episodes()->withTrashed()->exists();
    }

    public function getAdminAttribute()
    {
        return Student::firstWhere('email', $this->admin_email);
    }
}
