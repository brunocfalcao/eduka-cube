<?php

namespace Eduka\Cube\Observers;

use App\Mail\MailTest;
use Eduka\Cube\Models\Subscriber;
use Eduka\Cube\Services\ApplicationLog;
use Illuminate\Support\Facades\Mail;

class SubscriberObserver
{
    /**
     * Handle the Subscriber "saving" event.
     *
     * @param  \Eduka\Models\Subscriber  $subscriber
     * @return void
     */
    public function saving(Subscriber $subscriber)
    {
        //
    }

    /**
     * Handle the Subscriber "saving" event.
     *
     * @param  \Eduka\Models\Subscriber  $subscriber
     * @return void
     */
    public function saved(Subscriber $subscriber)
    {
        //
    }

    /**
     * Handle the Subscriber "creating" event.
     *
     * @param  \Eduka\Models\Subscriber  $subscriber
     * @return void
     */
    public function creating(Subscriber $subscriber)
    {
        //
    }

    /**
     * Handle the Subscriber "created" event.
     *
     * @param  \Eduka\Models\Subscriber  $subscriber
     * @return void
     */
    public function created(Subscriber $subscriber)
    {
        Mail::to($subscriber->email)
            ->send(new MailTest());

        // Save on application log.
        ApplicationLog::parameters(['operation' => 'subscribe'])
                      ->model($subscriber)
                      ->log("Subscriber created ({$subscriber->name} - {$subscriber->email})");
    }

    /**
     * Handle the Subscriber "updated" event.
     *
     * @param  \Eduka\Models\Subscriber  $subscriber
     * @return void
     */
    public function updated(Subscriber $subscriber)
    {
        //
    }

    /**
     * Handle the Subscriber "deleted" event.
     *
     * @param  \Eduka\Models\Subscriber  $subscriber
     * @return void
     */
    public function deleted(Subscriber $subscriber)
    {
        //
    }

    /**
     * Handle the Subscriber "restored" event.
     *
     * @param  \Eduka\Models\Subscriber  $subscriber
     * @return void
     */
    public function restored(Subscriber $subscriber)
    {
        //
    }

    /**
     * Handle the Subscriber "force deleted" event.
     *
     * @param  \Eduka\Models\Subscriber  $subscriber
     * @return void
     */
    public function forceDeleted(Subscriber $subscriber)
    {
        //
    }
}
