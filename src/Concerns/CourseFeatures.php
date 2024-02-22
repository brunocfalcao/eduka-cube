<?php

namespace Eduka\Cube\Concerns;

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

    public function createBucketNameUsing()
    {
        return $this->canonical;
    }

    public function getBucketName()
    {
        return $this->backblaze_bucket_name;
    }

    public function getCurrentProgress(): int
    {
        return $this->progress;
    }
}
