<?php

namespace Eduka\Cube\Models;

use Brunocfalcao\LaravelHelpers\Traits\ForModels\HasCanonicals;
use Brunocfalcao\LaravelHelpers\Traits\ForModels\HasCustomQueryBuilder;
use Brunocfalcao\LaravelHelpers\Traits\ForModels\HasUuids;
use Brunocfalcao\LaravelHelpers\Traits\ForModels\HasValidations;
use Eduka\Abstracts\Classes\EdukaModel;
use Eduka\Cube\Concerns\CourseFeatures;
use Illuminate\Validation\Rule;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Course extends EdukaModel implements HasMedia
{
    use CourseFeatures,
        HasCanonicals,
        HasCustomQueryBuilder,
        HasUuids,
        HasValidations,
        InteractsWithMedia;

    protected $with = ['admin', 'backend'];

    protected $casts = [
        'prelaunched_at' => 'datetime',
        'launched_at' => 'datetime',
        'retired_at' => 'datetime',

        'is_active' => 'boolean',
        'is_ppp_enabled' => 'boolean',

        'theme' => 'array',
    ];

    // Fields that have a static validation.
    public $rules = [
        'name' => ['required'],
        'description' => ['required'],
        'canonical' => ['required'],
        'uuid' => ['required'],
        'domain' => ['required'],
        'service_provider_class' => ['required', 'class_exists'],
        'is_active' => ['nullable', 'boolean'],
        'is_ppp_enabled' => ['nullable', 'boolean'],
        'clarity_code' => ['nullable', 'string'],
    ];

    // Fields that have a computed validation.
    public function getRules()
    {
        return [
            'canonical' => ['required', Rule::unique('courses')->ignore($this->id)],
            'service_provider_class' => ['required', 'string', Rule::unique('courses')->ignore($this->id)],
            'domain' => ['required', 'string', Rule::unique('courses')->ignore($this->id)],
            'prelaunched_at' => [
                'nullable',
                Rule::when($this->launched_at !== null, 'before:launched_at'),
            ],
            'launched_at' => [
                'nullable',
                Rule::when($this->prelaunched_at !== null, 'after:prelaunched_at'),
            ],
            'retired_at' => [
                'nullable',
                Rule::when($this->launched_at !== null, 'after:launched_at'),
            ],
        ];
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('thumbnail')
            ->fit(Fit::Contain, 300)
            ->nonQueued();
    }

    // Relationship registered.
    public function admin()
    {
        return $this->belongsTo(Student::class, 'student_admin_id');
    }

    // Relationship registered.
    public function backend()
    {
        return $this->belongsTo(Backend::class);
    }

    // Relationship registered.
    public function students()
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
        return ! $this->episodes()->exists();
    }
}
