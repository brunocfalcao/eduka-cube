<?php

namespace Eduka\Cube\Observers;

use Eduka\Cube\Models\Visit;

class VisitObserver
{
    public function created(Visit $visit)
    {
        //
    }

    public function updated(Visit $visit)
    {
        //
    }

    public function saving(Visit $visit)
    {
        //
    }

    public function saved(Visit $visit)
    {
        /**
         * Trigger geolocation job to try to enrich user visit geolocation data.
         */
        info('-- visit saved, triggering geolocation job --');
    }

    public function deleted(Visit $visit)
    {
        //
    }

    public function restored(Visit $visit)
    {
        //
    }

    public function forceDeleted(Visit $visit)
    {
        //
    }
}
