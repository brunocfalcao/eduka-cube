<?php

namespace Eduka\Cube;

use Eduka\Abstracts\Classes\EdukaServiceProvider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;

class CubeServiceProvider extends EdukaServiceProvider
{
    public function boot()
    {
        $this->registerPolicies();
        $this->registerObservers();

        // Eloquent strict behavior except production.
        Model::shouldBeStrict(! $this->app->isProduction());

        $this->registerCommands();

        parent::boot();
    }

    public function register()
    {
        //
    }

    protected function registerCommands()
    {
        $this->commands([]);
    }

    protected function registerPolicies()
    {
        $modelPaths = glob(__DIR__.'/Models/*.php');
        $modelClasses = array_map(function ($path) {
            return basename($path, '.php');
        }, $modelPaths);

        foreach ($modelClasses as $model) {
            $modelClass = "\\Eduka\\Cube\\Models\\{$model}";
            $policyClass = "\\Eduka\\Cube\\Policies\\{$model}Policy";

            try {
                if (class_exists($modelClass) && class_exists($policyClass)) {
                    $modelClassObject = new $modelClass;
                    $policyClassObject = new $policyClass;

                    Gate::policy(get_class($modelClassObject), get_class($policyClassObject));
                }
            } catch (\Exception $ex) {
                info('Policy Registration Error: '.$ex->getMessage());
            }
        }
    }

    protected function registerGlobalScopes()
    {
        $modelPaths = glob(__DIR__.'/Models/*.php');
        $modelClasses = array_map(function ($path) {
            return basename($path, '.php');
        }, $modelPaths);

        foreach ($modelClasses as $model) {
            $modelClass = "\\Eduka\\Cube\\Models\\{$model}";
            $scopeClass = "\\Eduka\\Cube\\Scopes\\{$model}Scope";

            try {
                if (class_exists($modelClass) && class_exists($scopeClass)) {
                    $modelClass::addGlobalScope(new $scopeClass);
                }
            } catch (\Exception $ex) {
            }
        }
    }

    protected function registerObservers()
    {
        $modelPaths = glob(__DIR__.'/Models/*.php');
        $modelClasses = array_map(function ($path) {
            return basename($path, '.php');
        }, $modelPaths);

        foreach ($modelClasses as $model) {
            $modelClass = "\\Eduka\\Cube\\Models\\{$model}";
            $observerClass = "\\Eduka\\Cube\\Observers\\{$model}Observer";

            try {
                if (class_exists($modelClass) && class_exists($observerClass)) {
                    $modelClass::observe($observerClass);
                }
            } catch (\Exception $ex) {
                info('Observer Registration Error: '.$ex->getMessage());
            }
        }
    }
}
