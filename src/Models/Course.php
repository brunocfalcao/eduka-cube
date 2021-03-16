<?php

namespace Eduka\Cube\Models;

use Eduka\Abstracts\EdukaModel;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Course extends EdukaModel implements HasMedia
{
    use InteractsWithMedia;

    protected $table = 'course';

    public $timestamps = false;

    protected $appends = ['is_launched'];

    protected $casts = [
        'meta' => 'array',
    ];

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('default')
            ->singleFile();
    }

    /**
     * The registered logo in the media collection.
     *
     * @param Media|null $media
     *
     * @return void
     */
    public function registerMediaConversions(Media $media = null): void
    {
        /* Image conversion for social media (facebook, twitter) */
        $this->addMediaConversion('social')
             ->fit(Manipulations::FIT_CONTAIN, 1200, 600);

        /* Image conversion for the Nova backoffice thumbs */
        $this->addMediaConversion('thumb')
             ->fit(Manipulations::FIT_CONTAIN, 300, 150);

        /* Image conversion for the email header templates */
        $this->addMediaConversion('email')
            ->fit(Manipulations::FIT_CONTAIN, 260, 130);
    }

    public static function active()
    {
        return static::firstOr(function () {
        });
    }

    public function getIsLaunchedAttribute()
    {
        return $this->launched_at <= now() && ! is_null($this->launched_at) ? true : false;
    }
}
