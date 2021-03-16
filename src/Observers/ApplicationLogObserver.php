<?php

namespace Eduka\Cube\Observers;

use Eduka\Cube\Models\ApplicationLog;

class ApplicationLogObserver
{
    /**
     * Handle the ApplicationLog "saved" event.
     *
     * @param  \Eduka\Models\ApplicationLog  $applicationLog
     * @return void
     */
    public function saved(ApplicationLog $applicationLog)
    {
        //
    }

    /**
     * Handle the ApplicationLog "created" event.
     *
     * @param  \Eduka\Models\ApplicationLog  $applicationLog
     * @return void
     */
    public function created(ApplicationLog $applicationLog)
    {
        //
    }

    /**
     * Handle the ApplicationLog "updated" event.
     *
     * @param  \Eduka\Models\ApplicationLog  $applicationLog
     * @return void
     */
    public function updated(ApplicationLog $applicationLog)
    {
        //
    }

    /**
     * Handle the ApplicationLog "deleted" event.
     *
     * @param  \Eduka\Models\ApplicationLog  $applicationLog
     * @return void
     */
    public function deleted(ApplicationLog $applicationLog)
    {
        //
    }

    /**
     * Handle the ApplicationLog "restored" event.
     *
     * @param  \Eduka\Models\ApplicationLog  $applicationLog
     * @return void
     */
    public function restored(ApplicationLog $applicationLog)
    {
        //
    }

    /**
     * Handle the ApplicationLog "force deleted" event.
     *
     * @param  \Eduka\Models\ApplicationLog  $applicationLog
     * @return void
     */
    public function forceDeleted(ApplicationLog $applicationLog)
    {
        //
    }
}
