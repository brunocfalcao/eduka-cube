<?php

namespace Eduka\Cube\Abstracts;

use Brunocfalcao\LaravelHelpers\Traits\HasCustomQueryBuilder;
use Illuminate\Database\Eloquent\Model;

abstract class EdukaModel extends Model
{
    use HasCustomQueryBuilder;

    protected $guarded = [];

    public function canBeDeleted()
    {
        return true;
    }
}
