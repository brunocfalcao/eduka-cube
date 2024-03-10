<?php

namespace Eduka\Cube\Concerns;

use Illuminate\Support\Facades\Storage;

trait CourseFeatures
{
    public function state()
    {
        /**
         * _date:
         * x          x             x           x           x
         * |          |             |           |           |
         * |----------+-------------+-----------+-----------|
         *   inactive   prelaunched    launched    retired
         *
         * Everyting is overriden by the is_active state.
         * -> active, inactive.
         */
        if (! $this->is_active || now() < $this->prelaunched_at ||
            (empty($this->prelaunched_at) &&
             empty($this->launched_at) &&
             empty($this->retired_at))
        ) {
            return 'inactive';
        }

        if (now()->between($this->prelaunched_at, $this->launched_at)) {
            return 'prelaunched';
        }

        if (now() > $this->launched_at && empty($this->retired_at) ||
            now()->between($this->launched_at, $this->retired_at)) {
            return 'launched';
        }

        if (now() > $this->retired_at) {
            return 'retired';
        }
    }

    /**
     * Retrieves the specified variant model, and if not found returns
     * the default one.
     */
    public function getVariantOrDefault(?Variant $variant = null)
    {
        return $variant ?? $this->getDefaultVariant();
    }

    // Returns the default variant for the current course.
    public function getDefaultVariant()
    {
        if ($this->variants->count() > 1) {
            return $this->variants->firstWhere('is_default', true);
        } else {
            return $this->variants->first();
        }
    }

    // Registers its service provider. Used in Nereus, mostly.
    public function registerSelfProvider()
    {
        app()->register($this->provider_namespace);
    }

    // Generates the meta-name and meta-property tags based on the course data.
    public function setMetas()
    {
        $this->meta_names = [
            'twitter:description' => $this->description,
            'twitter:card' => 'summary_large_image',
            'twitter:site' => $this->twitter_handle,
            'twitter:image' => Storage::url($this->filename),
            'twitter:creator' => $this->twitter_handle,
            'twitter:title' => $this->name,
        ];

        $this->meta_properties = [
            'og:description' => $this->description,
            'og:url' => 'https://'.$this->domain,
            'og:type' => 'article',
            'og:image' => Storage::url($this->filename),
            'og:title' => $this->name,
        ];
    }
}
