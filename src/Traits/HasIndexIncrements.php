<?php

namespace Eduka\Cube\Traits;

use Illuminate\Database\Eloquent\Model;

trait HasIndexIncrements
{
    /**
     * Allows a model that has an "index" column to be auto-incremented
     * based, in necessary, a specific relationship condition.
     *
     * @param Model $model
     * @param string $column
     * @param type|null $relationship
     *
     * @return void
     */
    public function checkIndex(Model $model, string $column = 'index', $relationship = null)
    {
        $query = $model::query();

        // Scoping means to only pick the models that belongs to this
        // foreign key.
        if ($relationship) {
            $foreignKeyName = $relationship->getForeignKeyName();
            $query->where($foreignKeyName, $model->{$foreignKeyName});
        }

        // Index changed? Update all forward indexes.
        if ($model->isDirty($column) && $model->{$column} !== null) {
            $query->where($column, '>=', $model->{$column});

            //Recompute forward all indexes.
            $query->get()
                   ->each(function ($item) use ($column) {
                       $item->increment($column);
                   });
        }

        if ($model->{$column} == null) {
            $model->{$column} = $query->get()->count() + 1;
        }
    }
}
