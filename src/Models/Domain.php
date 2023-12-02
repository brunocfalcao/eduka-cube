<?php

namespace Eduka\Cube\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use MasteringNova\Database\Factories\DomainFactory;

class Domain extends Model
{
    use Notifiable, SoftDeletes;

    protected $guarded = [];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    protected static function newFactory(): Factory
    {
        return DomainFactory::new();
    }
}
