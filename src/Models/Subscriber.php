<?php

namespace Eduka\Cube\Models;

use Eduka\Abstracts\EdukaModel;
use Eduka\Database\Factories\SubscriberFactory;

class Subscriber extends EdukaModel
{
    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function logs()
    {
        return $this->morphMany(ApplicationLog::class, 'loggable');
    }

    protected static function newFactory()
    {
        return SubscriberFactory::new();
    }
}
