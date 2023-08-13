<?php

namespace Eduka\Cube\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    use Notifiable;
    use SoftDeletes;
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
    ];


    /**
     * Create a new factory instance for the model.
     */
    // protected static function newFactory(): Factory
    // {
    //     return CourseFactory::new();
    // }

}
