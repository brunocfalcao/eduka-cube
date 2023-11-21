<?php

namespace Eduka\Cube\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Variant extends Model
{
    use HasFactory, SoftDeletes;
    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected $guarded = [];

    protected $casts = [
        'is_default' => 'boolean',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function videos()
    {
        return $this->hasManyDeepFromRelations($this->chapterVideos(), (new ChapterVariant())->variants());
    }

    public function chapterVariants()
    {
        return $this->hasManyThrough(ChapterVariant::class, Chapter::class);
    }

    public function priceOverrideInCents()
    {
        return (int) $this->lemonsqueezy_price_override * 100;
    }
}
