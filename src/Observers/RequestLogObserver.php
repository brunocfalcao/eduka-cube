<?php

namespace Eduka\Cube\Observers;

use Eduka\Cube\Models\RequestLog;

class RequestLogObserver
{
    public function saving(RequestLog $model)
    {
        $model->validate();
    }
}
