<?php

namespace Eduka\Cube\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Variant extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'is_default' => 'boolean',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function chapters()
    {
        return $this->belongsToMany(Chapter::class, 'chapter_variant')
            ->withPivot('index')
            ->withTimestamps();
    }

    public function priceOverrideInCents()
    {
        return (int) $this->lemonsqueezy_price_override * 100;
    }

    public function createBucketNameUsing(): string
    {
        return $this->course->canonical;
    }

    public function getBucketName(): ?string
    {
        return $this->backblaze_bucket_name;
    }
}
