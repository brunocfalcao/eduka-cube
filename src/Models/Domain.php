<?php

namespace Eduka\Cube\Models;

use Eduka\Cube\Abstracts\EdukaModel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use MasteringNova\Database\Factories\DomainFactory;

class Domain extends EdukaModel
{
    use Notifiable, SoftDeletes;

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    protected static function newFactory(): Factory
    {
        return DomainFactory::new();
    }
}
