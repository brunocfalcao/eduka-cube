<?php

namespace Eduka\Cube\Models;

use Eduka\Cube\Abstracts\EdukaModel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\SoftDeletes;
use MasteringNova\Database\Factories\ChapterFactory;

class Chapter extends EdukaModel
{
    use SoftDeletes;

    public function videos()
    {
        return $this->belongsToMany(Video::class);
    }

    public function variants()
    {
        return $this->belongsToMany(Variant::class);
    }

    protected static function newFactory(): Factory
    {
        return ChapterFactory::new();
    }
}
