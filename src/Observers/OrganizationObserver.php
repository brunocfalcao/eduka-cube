<?php

namespace Eduka\Cube\Observers;

use Eduka\Cube\Models\Organization;

class OrganizationObserver
{
    public function saving(Organization $organization)
    {
        $organization->validate();
    }
}
