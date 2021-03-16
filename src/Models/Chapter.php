<?php

namespace Eduka\Cube\Models;

use Eduka\Abstracts\EdukaModel;
use Eduka\Cube\Factories\ChapterFactory;

class Chapter extends EdukaModel
{
    protected $casts = [
        'published_at' => 'datetime',
        'archived_at'  => 'datetime',

        'is_enabled'   => 'boolean',
        'is_visible'   => 'boolean',
        'is_clickable' => 'boolean',

        'index'        => 'integer',
    ];

    protected static function newFactory()
    {
        return ChapterFactory::new();
    }

    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    public function scopeVisible($query)
    {
        return $query->where('is_enabled', true)
                     ->whereNull('archived_at');
    }

    public function scopeNonArchived($query)
    {
        return $query->whereNull('archived_at');
    }

    public function getIsVisibleAttribute()
    {
        return $this->is_enabled &&
              ! $this->archived_at;
    }

    public function getIsClickableAttribute()
    {
        return $this->is_enabled &&
              ! $this->archived &&
               $this->published_at <= now();
    }

    public function previousIndex()
    {
        return $this->where('index', $this->index--);
    }

    public function nextIndex()
    {
        return $this->where('index', $this->index++);
    }

    public function next()
    {
        return $this->nonArchived()
                    ->nextIndex()
                    ->firstOr(function () {
                    });
    }

    public function previous()
    {
        return $this->nonArchived()
                    ->previousIndex()
                    ->firstOr(function () {
                    });
    }
}
