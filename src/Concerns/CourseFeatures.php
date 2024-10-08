<?php

namespace Eduka\Cube\Concerns;

use Illuminate\Database\Eloquent\Casts\Attribute;
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

    public function getVariantByCanonical(string $canonical)
    {
        return $this->variants->where('canonical', $canonical)->first();
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
        app()->register($this->service_provider_class);
    }

    /**
     * Returns computed attribute 'metas', with all the meta tags
     * to be rendered in an HTML page.
     */
    public function getMetasAttribute()
    {
        return [
            'name|twitter:description' => $this->description,
            'name|twitter:card' => 'summary_large_image',
            'name|twitter:site' => $this->twitter_handle,
            'name|twitter:image' => url_with_app_http_scheme($this->domain, Storage::url($this->filename_logo)),
            'name|twitter:creator' => $this->twitter_handle,
            'name|twitter:title' => $this->name,

            'property|og:description' => $this->description,
            'property|og:url' => url_with_app_http_scheme($this->domain),
            'property|og:type' => 'article',
            'property|og:image' => url_with_app_http_scheme($this->domain, Storage::url($this->filename_logo)),
            'property|og:title' => $this->name,
        ];
    }
}
