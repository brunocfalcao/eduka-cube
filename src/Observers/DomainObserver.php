<?php

namespace Eduka\Cube\Observers;

use Eduka\Cube\Events\Domains\DomainSaved;
use Eduka\Cube\Models\Domain;

class DomainObserver
{
    public function saving(Domain $domain)
    {
        //
    }

    public function saved(Domain $domain)
    {
        // Call "DomainSaved" notification event if allowed.
        allow_if(
            config('eduka.system.stop_notifications') !== true,
            function () use ($domain) {
                DomainSaved::dispatch($domain);
            }
        );
    }

    public function created(Domain $domain)
    {
        //
    }

    public function updated(Domain $domain)
    {
        //
    }

    public function deleted(Domain $domain)
    {
        //
    }

    public function restored(Domain $domain)
    {
        //
    }

    public function forceDeleted(Domain $domain)
    {
        //
    }
}
