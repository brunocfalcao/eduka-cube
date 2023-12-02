<?php

namespace Eduka\Cube\Models;

use Eduka\Cube\Abstracts\EdukaModel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\SoftDeletes;
use MasteringNova\Database\Factories\SeriesFactory;

class Series extends EdukaModel
{
    use SoftDeletes;

    public function courses()
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
        return SeriesFactory::new();
    }
}
