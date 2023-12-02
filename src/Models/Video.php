<?php

namespace Eduka\Cube\Models;

use Eduka\Cube\Abstracts\EdukaModel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use MasteringNova\Database\Factories\VideoFactory;

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
        $domains = [];

        if ($this->meta_canonical_url) {
            $parsedUrl = parse_url($this->meta_canonical_url);
            $domain = Str::of($parsedUrl['host'] ?? '')->trim('www.')->toString();
            $domains = [$domain];
        }

        return [
            'name' => $this->name,
            'description' => $this->details,
            'embed.title.name' => 'show',
            'hide_from_vimeo' => true,
            'privacy.view' => 'unlisted',
            'privacy.embed' => 'whitelist',
            'embed_domains' => $domains,
        ];
    }

    public function videoStorage()
    {
        return $this->hasOne(VideoStorage::class, 'video_id');
    }

    public function hasVimeoId(): bool
    {
        return $this->vimeo_id !== '' && ! is_null($this->vimeo_id);
    }

    protected static function newFactory(): Factory
    {
        return VideoFactory::new();
    }
}
