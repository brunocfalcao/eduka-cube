<?php

namespace App\Listeners;

use Eduka\Cube\Events\Variants\VariantCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateVimeoProject
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(VariantCreated $event): void
    {
        
    }
}
