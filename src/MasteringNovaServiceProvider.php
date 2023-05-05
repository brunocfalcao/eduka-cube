<?php

namespace MasteringNova;

use Eduka\Abstracts\Classes\EdukaServiceProvider;
use MasteringNova\Commands\ETLData;

class MasteringNovaServiceProvider extends EdukaServiceProvider
{
    public function boot()
    {
        $this->customViewNamespace(__DIR__.'/../resources/views', 'course');

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        parent::boot();
    }

    public function register()
    {
        parent::register();
    }

    protected function registerCommands()
    {
        $this->commands([
            ETLData::class,
        ]);
    }
}
