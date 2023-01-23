<?php

namespace Eduka\Cube\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Visit extends Model
{
    use Notifiable;

    protected $guarded = [];

    protected $casts = [
        'user_id' => 'integer',
        'course_id' => 'integer',
        'goal_id' => 'integer',
        'affiliate_id' => 'integer',
        'is_bot' => 'boolean',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
