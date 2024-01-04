<?php

namespace Eduka\Cube\Models;

use Brunocfalcao\LaravelHelpers\Traits\HasCustomQueryBuilder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use LemonSqueezy\Laravel\Billable;

class User extends Authenticatable
{
    use Billable, HasCustomQueryBuilder, Notifiable, SoftDeletes;

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relationship registered.
    public function variants()
    {
        return $this->belongsToMany(Variant::class)
                    ->withTimestamps();
    }

    // Relationship registered.
    public function orders()
    {
        return $this->belongsToMany(Order::class)
                    ->withTimestamps();
    }

    // Relationship registered.
    public function courses()
    {
        return $this->belongsToMany(Course::class)
                    ->withTimestamps();
    }

    // Relationship registered.
    public function courseAsAdmin()
    {
        return $this->belongsTo(Course::class, 'course_id_as_admin');
    }
}
