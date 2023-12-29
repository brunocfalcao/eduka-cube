<?php

namespace Eduka\Cube\Models;

use Eduka\Cube\Abstracts\EdukaModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Video extends EdukaModel
{
    use SoftDeletes;

    protected $casts = [
        'is_visible' => 'boolean',
        'is_active' => 'boolean',
        'is_free' => 'boolean',
        'duration' => 'integer',
    ];

    public function links()
    {
        return $this->hasMany(Link::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class)
                    ->withTimestamps();
    }

    public function series()
    {
        return $this->belongsToMany(Series::class)
                    ->withTimestamps();
    }

    public function chapters()
    {
        return $this->belongsToMany(Chapter::class);
    }

    public function variants()
    {
        return $this->belongsToMany(Variant::class)
                    ->withTimestamps();
    }

    public function usersCompleted()
    {
        return $this->belongsToMany(User::class)
                    ->withTimestamps();
    }

    public function scopeIsVisible($query)
    {
        return $query->where('is_visible', true);
    }

    public function url(): string
    {
        if (! $this->is_active) {
            return '#';
        }

        if (! auth()->check() && ! $this->is_free) {
            return route('purchase.view');
        }

        return route('video.watch', $this->id);
    }

    public function vimeoMetadata(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'embed.title.name' => 'show',
            'hide_from_vimeo' => true,
            'privacy.view' => 'unlisted',
            'privacy.embed' => 'whitelist',
            'embed_domains' => $this->domains->pluck('name'),
        ];
    }

    public function videoStorage()
    {
        return $this->hasOne(VideoStorage::class);
    }

    public function hasVimeoId(): bool
    {
        return $this->vimeo_id !== '' && ! is_null($this->vimeo_id);
    }
}
