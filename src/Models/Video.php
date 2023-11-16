<?php

namespace Eduka\Cube\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use MasteringNova\Database\Factories\VideoFactory;

class Video extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'vimeo_id' => 'integer',
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
        return $this->belongsToMany(Chapter::class)
                    ->withTimestamps();
    }

    public function usersCompleted()
    {
        return $this->belongsToMany(User::class, 'videos_completed')
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
            'description' => $this->meta_description,
        ];
    }

    public function videoStorage()
    {
        return $this->hasOne(VideoStorage::class, 'video_id');
    }

    protected static function newFactory(): Factory
    {
        return VideoFactory::new();
    }
}
