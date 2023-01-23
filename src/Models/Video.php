<?php

namespace Eduka\Cube\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
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
        return $this->belongsToMany(Tag::class);
    }

    public function series()
    {
        return $this->belongsToMany(Series::class);
    }

    public function chapters()
    {
        return $this->belongsToMany(Chapter::class);
    }

    public function usersCompleted()
    {
        return $this->belongsToMany(User::class, 'videos_completed');
    }
}
