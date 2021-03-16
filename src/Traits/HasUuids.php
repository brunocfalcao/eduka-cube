<?php

namespace Eduka\Cube\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait HasUuids
{
    /**
     * Adds an uuid in case the corresponding "uuid" column is empty.
     *
     * @param Model $model
     * @param string $column
     *
     * @return void
     */
    public function checkUuid(Model $model, string $column = 'uuid')
    {
        if ($model->$column == null) {
            $model->$column = (string) Str::uuid();
        }
    }
}
