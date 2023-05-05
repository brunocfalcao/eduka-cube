<?php

namespace MasteringNova;

use Eduka\Abstracts\Classes\EdukaServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory as EloquentFactory;
use MasteringNova\Commands\ETLData;

class MasteringNovaServiceProvider extends EdukaServiceProvider
{
    public function boot()
    {
        $this->customViewNamespace(__DIR__.'/../resources/views', 'course');

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->registerEloquentFactoriesFrom(__DIR__.'/database/factories');

        parent::boot();
    }

    public function register()
    {
        parent::register();
    }

    /**
     * Register factories.
     */
    protected function registerEloquentFactoriesFrom(string $path)
    {
        // @TODO check, not working
        $this->app->make(EloquentFactory::class)->load($path);
    }

    protected function registerCommands()
    {
        $this->commands([
            ETLData::class,
        ]);
    }
}
