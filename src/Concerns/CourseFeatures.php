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
        if (! $this->is_active || now() < $this->prelaunched_date ||
            (empty($this->prelaunched_date) &&
             empty($this->launched_date) &&
             empty($this->retired_date))
        ) {
            return 'inactive';
        }

        if (now()->between($this->prelaunched_date, $this->launched_date)) {
            return 'prelaunched';
        }

        if (now() > $this->launched_date && empty($this->retired_date) ||
            now()->between($this->launched_date, $this->retired_date)) {
            return 'launched';
        }

        if (now() > $this->retired_date) {
            return 'retired';
        }
    }

    public function getVariantOrDefault(?Variant $variant = null)
    {
        return $variant ?? $this->getDefaultVariant();
    }

    public function getDefaultVariant()
    {
        if ($this->variants->count() > 1) {
            return $this->variants->firstWhere('is_default', true);
        } else {
            return $this->variants->first();
        }
    }

    public function getCurrentProgress()
    {
        return mt_rand(55, 85);
    }

    public function registerSelfProvider()
    {
        app()->register($this->provider_namespace);
    }
}
