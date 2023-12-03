<?php

namespace Eduka\Cube\Observers;

use Brunocfalcao\LaravelHelpers\Traits\CanValidateObserverAttributes;
use Eduka\Cube\Models\Series;

class SeriesObserver
{
    use CanValidateObserverAttributes;

    public function saving(Series $series)
    {
        $this->validate($series, [
            'name' => 'required',
        ]);
    }
}
