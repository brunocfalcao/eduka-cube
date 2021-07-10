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

    protected $casts = [
        'launched_at' => 'datetime',
        'is_active'   => 'boolean',
        'meta'        => 'array',
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

    public static function launched()
    {
        return course()->is_active && course()->launched_at < now();
    }

    public static function getMetaTags()
    {
        return ['twitter:site' => '@brunocfalcao',
                'twitter:title' => 'My Course name',
                'twitter:description' => 'My course resumed description', ];

        /*
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:site" content="@brunocfalcao" />
        <meta name="twitter:title" content="Nova Advanced UI" />
        <meta name="twitter:description" content="Nova training course in advanced User Interface development" />
        <meta name="twitter:image" content="https://tailwindui.com/img/og-image.png" />
        <meta name="twitter:creator" content="@brunocfalcao" />
        <meta property="og:url" content="https://www.tailwindui.com/" />
        <meta property="og:type" content="article" />
        <meta property="og:title" content="Tailwind UI" />
        <meta property="og:description" content="Beautiful UI components by the creators of Tailwind CSS." />
        <meta property="og:image" content="https://tailwindui.com/img/og-image.png" />
        <meta property="description" content="Beautiful UI components by the creators of Tailwind CSS." />
        */
    }
}
