<?php

namespace Eduka\Cube\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    use Notifiable, SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'response_body' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function variant()
    {
        return $this->belongsTo(Variant::class);
    }
}
