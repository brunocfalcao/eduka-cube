<?php

namespace Eduka\Cube;

use Eduka\Abstracts\Classes\EdukaServiceProvider;
use Eduka\Cube\Commands\CreateCoupons;
use Eduka\Cube\Models\Chapter;
use Eduka\Cube\Models\Coupon;
use Eduka\Cube\Models\Course;
use Eduka\Cube\Models\Domain;
use Eduka\Cube\Models\Link;
use Eduka\Cube\Models\Order;
use Eduka\Cube\Models\Series;
use Eduka\Cube\Models\Subscriber;
use Eduka\Cube\Models\Tag;
use Eduka\Cube\Models\User;
use Eduka\Cube\Models\Variant;
use Eduka\Cube\Models\Video;
use Eduka\Cube\Models\VideoCompleted;
use Eduka\Cube\Models\VideoStorage;
use Eduka\Cube\Observers\ChapterObserver;
use Eduka\Cube\Observers\CouponObserver;
use Eduka\Cube\Observers\CourseObserver;
use Eduka\Cube\Observers\DomainObserver;
use Eduka\Cube\Observers\LinkObserver;
use Eduka\Cube\Observers\OrderObserver;
use Eduka\Cube\Observers\SeriesObserver;
use Eduka\Cube\Observers\SubscriberObserver;
use Eduka\Cube\Observers\TagObserver;
use Eduka\Cube\Observers\UserObserver;
use Eduka\Cube\Observers\VariantObserver;
use Eduka\Cube\Observers\VideoCompletedObserver;
use Eduka\Cube\Observers\VideoObserver;
use Eduka\Cube\Observers\VideoStorageObserver;
use Eduka\Cube\Policies\ChapterPolicy;
use Eduka\Cube\Policies\CouponPolicy;
use Eduka\Cube\Policies\CoursePolicy;
use Eduka\Cube\Policies\DomainPolicy;
use Eduka\Cube\Policies\LinkPolicy;
use Eduka\Cube\Policies\OrderPolicy;
use Eduka\Cube\Policies\SeriesPolicy;
use Eduka\Cube\Policies\SubscriberPolicy;
use Eduka\Cube\Policies\TagPolicy;
use Eduka\Cube\Policies\UserPolicy;
use Eduka\Cube\Policies\VariantPolicy;
use Eduka\Cube\Policies\VideoCompletedPolicy;
use Eduka\Cube\Policies\VideoPolicy;
use Eduka\Cube\Policies\VideoStoragePolicy;
use Eduka\Nereus\Facades\Nereus;
use Illuminate\Auth\Events\Authenticated;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;

class CubeServiceProvider extends EdukaServiceProvider
{
    public function boot()
    {
        $this->registerPolicies();
        $this->registerObservers();

        // Global scopes are loaded except if on frontend.

        if (!Nereus::course()) {
            Event::listen(Authenticated::class, function ($event) {
                $this->registerGlobalScopes();
            });
        }

        $this->registerCommands();

        parent::boot();
    }

    public function register()
    {
        //
    }

    protected function registerCommands()
    {
        $this->commands([
            CreateCoupons::class,
        ]);
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
