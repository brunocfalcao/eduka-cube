<?php

namespace Eduka\Cube\Models;

use Eduka\Abstracts\EdukaModel;
use Eduka\Cube\Factories\VideoFactory;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Video extends EdukaModel implements HasMedia
{
    use InteractsWithMedia;

    protected $appends = [
        'duration_as_time', // hh:mm:ss
        'duration_readable', // 5 minutes and 2 seconds
        'is_visible',
        'is_clickable',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'archived_at'  => 'datetime',

        'is_enabled'   => 'boolean',
        'is_visible'   => 'boolean',
        'is_clickable' => 'boolean',

        'chapter_id'   => 'integer',
        'index'        => 'integer',
        'vimeo_id'     => 'integer',
        'duration'     => 'integer',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        /* Image conversion for social media (facebook, twitter) */
        $this->addMediaConversion('social')
             ->fit(Manipulations::FIT_CONTAIN, 1200, 600);

        /* Image conversion for the Nova backoffice thumbs */
        $this->addMediaConversion('thumb')
             ->fit(Manipulations::FIT_CONTAIN, 300, 150);
    }

    protected static function newFactory()
    {
        return VideoFactory::new();
    }

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }

    public function favoriteUsers()
    {
        return $this->belongsToMany(User::class, 'favorites')
                    ->as('favorite')
                    ->withTimestamps();
    }

    public function watchLaterUsers()
    {
        return $this->belongsToMany(User::class, 'watch_later')
                    ->as('watch_later')
                    ->withTimestamps();
    }

    public function markedAsSeenUsers()
    {
        return $this->belongsToMany(User::class, 'marked_as_seen')
                    ->as('marked_as_seen')
                    ->withTimestamps();
    }

    public function scopeVisible($query)
    {
        return $query->where('is_enabled', true)
                     ->whereNull('archived_at');
    }

    public function scopeNonArchived($query)
    {
        return $query->whereNull('archived_at');
    }

    public function getIsVisibleAttribute()
    {
        return $this->is_enabled &&
              ! $this->archived_at;
    }

    public function getIsClickableAttribute()
    {
        return $this->is_enabled &&
              ! $this->archived &&
               $this->published_at <= now();
    }

    /**
     * Converts a hh:mm:ss into a seconds duration.
     *
     * @param string $value
     */
    public function setDurationAttribute($value)
    {
        $parts = collect(explode(':', $value));

        $seconds = $parts->count() > 0 ? $parts->pop() : 0;
        $minutes = $parts->count() > 0 ? $parts->pop() : 0;
        $hours = $parts->count() > 0 ? $parts->pop() : 0;

        $this->attributes['duration'] =
            $seconds + $minutes * 60 + $hours * 3600;
    }

    /**
     * Returns a duration (int) as hh:mm:ss time string.
     *
     * @return string
     */
    public function getDurationAsTimeAttribute()
    {
        return collect(explode(':', gmdate('H:i:s', $this->duration)))
               ->reject(function ($item) {
                   return (int) $item == 0;
               })
               ->transform(function ($item) {
                   return (int) $item;
               })
               ->join(':');
    }

    /**
     * Returns a duration (int) as human readable (XX Hours, YY minutes and
     * ZZ seconds).
     *
     * @return string
     */
    public function getDurationReadableAttribute()
    {
        $duration = $this->duration_as_time;

        $parts = collect(explode(':', $duration));

        $seconds = $parts->count() > 0 ? $parts->pop() : 0;
        $minutes = $parts->count() > 0 ? $parts->pop() : 0;
        $hours = $parts->count() > 0 ? $parts->pop() : 0;

        $display = '';

        $displaySegments = [];

        if ($hours > 0) {
            $display .= "{$hours} hour".($hours > 1 ? 's' : '');
        }

        if ($minutes == 0 && $hours > 0) {
            $display .= ' and ';
        } elseif ($minutes > 0 && $hours > 0) {
            $display .= ', ';
        }

        if ($minutes > 0) {
            $display .= "{$minutes} minute".($minutes > 1 ? 's' : '');
        }

        if ($seconds > 0 && $minutes > 0) {
            $display .= ' and ';
        }

        if ($seconds > 0) {
            $display .= "{$seconds} second".($seconds > 1 ? 's' : '');
        }

        return $display;
    }

    public function fromThisChapter()
    {
        return $this->where('chapter_id', $video->chapter_id);
    }
}
