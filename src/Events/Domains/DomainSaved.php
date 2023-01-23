<?php

namespace Eduka\Cube\Events\Domains;

use Eduka\Cube\Models\Domain;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * This event is triggered each time a new domain is saved into the database.
 */
class DomainSaved
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $domain;

    public function __construct(Domain $domain)
    {
        $this->domain = $domain;
    }
}
