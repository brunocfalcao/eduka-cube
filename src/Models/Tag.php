<?php

namespace Eduka\Cube\Models;

use Eduka\Cube\Abstracts\EdukaModel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\SoftDeletes;
use MasteringNova\Database\Factories\TagFactory;

class Tag extends EdukaModel
{
    use SoftDeletes;

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function videos()
    {
        return $this->belongsToMany(Video::class)
                    ->withTimestamps();
    }

    protected static function newFactory(): Factory
    {
        return TagFactory::new();
    }
}
