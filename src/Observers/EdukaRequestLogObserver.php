<?php

namespace Eduka\Cube\Observers;

use Eduka\Cube\Models\EdukaRequestLog;

class EdukaRequestLogObserver
{
    public function saving(EdukaRequestLog $model)
    {
        $model->validate();
    }
}
