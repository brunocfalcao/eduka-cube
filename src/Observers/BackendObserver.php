<?php

namespace Eduka\Cube\Observers;

use Eduka\Cube\Models\Backend;

class BackendObserver
{
    public function saving(Backend $backend)
    {
        $backend->validate();
    }
}
