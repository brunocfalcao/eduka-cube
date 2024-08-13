<?php

namespace Eduka\Cube;

use Eduka\Abstracts\Classes\EdukaServiceProvider;
use Eduka\Cube\Rules\ClassExists;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class CubeServiceProvider extends EdukaServiceProvider
{
    public function boot()
    {
        $this->registerPolicies();
        $this->registerObservers();

        // Eloquent strict behavior except production.
        Model::shouldBeStrict(! $this->app->isProduction());

        $this->registerCommands();

        $this->registerRuleAliases();

        parent::boot();
    }

    public function register()
    {
        //
    }

    protected function registerRuleAliases()
    {
        Validator::extend('class_exists', function ($attribute, $value, $parameters, $validator) {
            $rule = new ClassExists;

            return $rule($attribute, $value, function ($message) use ($validator, $attribute) {
                $validator->errors()->add($attribute, $message);
            });
        });
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
