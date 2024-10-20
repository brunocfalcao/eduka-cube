<?php

namespace Eduka\Cube\Models;

use Brunocfalcao\LaravelHelpers\Traits\ForModels\HasAutoIncrementsByGroup;
use Brunocfalcao\LaravelHelpers\Traits\ForModels\HasCanonicals;
use Brunocfalcao\LaravelHelpers\Traits\ForModels\HasCustomQueryBuilder;
use Brunocfalcao\LaravelHelpers\Traits\ForModels\HasUuids;
use Brunocfalcao\LaravelHelpers\Traits\ForModels\HasValidations;
use Carbon\Carbon;
use Eduka\Abstracts\Classes\EdukaModel;
use Eduka\Cube\Concerns\EpisodeFeatures;
use Illuminate\Validation\Rule;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Episode extends EdukaModel implements HasMedia
{
    use EpisodeFeatures,
        HasAutoIncrementsByGroup,
        HasCanonicals,
        HasCustomQueryBuilder,
        HasUuids,
        HasValidations,
        InteractsWithMedia;

    protected $with = ['course', 'chapter'];

    protected $appends = ['duration_for_humans', 'is_new'];

    protected $casts = [
        'is_visible' => 'boolean',
        'is_active' => 'boolean',
        'is_free' => 'boolean',

        'duration' => 'integer',
    ];

    public $rules = [
        'name' => ['required', 'string'],
        'description' => ['nullable'],
        'index' => ['required'],
        'course_id' => ['required', 'exists:courses,id'],
        'duration' => ['nullable', 'integer'],
        'is_visible' => ['nullable', 'boolean'],
        'is_active' => ['nullable', 'boolean'],
        'is_free' => ['nullable', 'boolean'],
        'vimeo_id' => ['nullable', 'string'],
        'filename' => ['nullable', 'string'],
    ];

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('thumbnail')
            ->fit(Fit::Contain, 300)
            ->nonQueued();
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function getRules()
    {
        return [
            'uuid' => ['required', Rule::unique('episodes')->ignore($this->id)],
            'canonical' => ['required', Rule::unique('episodes')->ignore($this->id)],
        ];
    }

    // Relationship registered.
    public function studentsThatBookmarked()
    {
        return $this->belongsToMany(Student::class, 'episode_student_bookmarked');
    }

    // Relationship registered.
    public function studentsThatSaw()
    {
        return $this->belongsToMany(Student::class, 'episode_student_seen');
    }

    // Relationship registered.
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Relationship registered.
    public function links()
    {
        return $this->hasMany(Link::class);
    }

    // Relationship verified.
    public function tags()
    {
        return $this->belongsToMany(Tag::class)
            ->withTimestamps();
    }

    // Relationship registered.
    public function series()
    {
        return $this->belongsToMany(Series::class)
            ->withTimestamps();
    }

    // Relationship registered.
    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }

    public function getDurationForHumansAttribute()
    {
        $seconds = $this->duration;
        $hours = intdiv($seconds, 3600);
        $seconds %= 3600;
        $minutes = intdiv($seconds, 60);
        $seconds %= 60;

        $humanDuration = '';
        if ($hours > 0) {
            $humanDuration .= $hours . 'h ';
        }
        if ($minutes > 0) {
            $humanDuration .= $minutes . 'm ';
        }
        if (($hours == 0 || $minutes == 0) && $seconds > 0 || empty($humanDuration)) {
            $humanDuration .= $seconds . 's';
        }

        return trim($humanDuration);
    }

    public function getThumbnailURL() {}

    public function getIsNewAttribute()
    {
        $createdAt = new Carbon($this->created_at);

        return $createdAt->greaterThanOrEqualTo(Carbon::now()->subDays(30));
    }
}
