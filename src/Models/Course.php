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

        'is_active' => 'boolean',
        'is_ppp_enabled' => 'boolean',

        'meta_names' => 'array',
        'meta_properties' => 'array',
    ];

    public $rules = [
        'name' => ['required', 'string'],
        'canonical' => ['required'],
        'meta_names' => ['nullable'],
        'meta_properties' => ['nullable'],
        'domain' => ['required', 'string'],
        'provider_namespace' => ['nullable', 'string'],
        'is_active' => ['nullable', 'boolean'],
        'is_ppp_enabled' => ['nullable', 'boolean'],
        'lemon_squeezy_store_id' => ['nullable', 'string'],
        'vimeo_uri_key' => ['nullable', 'string'],
        'backblaze_bucket_name' => ['nullable', 'string'],
    ];

    // Relationship registered.
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

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
    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    public function canBeDeleted()
    {
        // No active videos part of this chapter.
        return ! $this->videos()->withTrashed()->exists();
    }

    public function getAdminAttribute()
    {
        return User::firstWhere('email', $this->admin_email);
    }
}
