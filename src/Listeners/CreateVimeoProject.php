<?php

namespace App\Listeners;

use Eduka\Cube\Events\Variants\VariantCreated;

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
