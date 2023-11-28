<?php

namespace Eduka\Cube\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use MasteringNova\Database\Factories\ChapterFactory;

class Chapter extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function variant()
    {
        return $this->belongsTo(Variant::class);
    }

    // public function variants()
    // {
    //     return $this->belongsToMany(Variant::class, 'chapter_variant')
    //         ->withPivot('index')
    //         ->withTimestamps();
    // }

    public function videos()
    {
        return $this->hasMany(Video::class, 'chapter_id');
    }

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory(): Factory
    {
        return ChapterFactory::new();
    }
}
