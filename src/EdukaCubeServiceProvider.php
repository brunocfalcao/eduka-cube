<?php

namespace Eduka\Cube;

use Eduka\Cube\Commands\FreshSeed;
use Eduka\Cube\Models\ApplicationLog;
use Eduka\Cube\Models\Chapter;
use Eduka\Cube\Models\Course;
use Eduka\Cube\Models\Subscriber;
use Eduka\Cube\Models\User;
use Eduka\Cube\Models\Video;
use Eduka\Cube\Observers\ApplicationLogObserver;
use Eduka\Cube\Observers\ChapterObserver;
use Eduka\Cube\Observers\CourseObserver;
use Eduka\Cube\Observers\SubscriberObserver;
use Eduka\Cube\Observers\UserObserver;
use Eduka\Cube\Observers\VideoObserver;
use Eduka\Cube\Policies\VideoPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\ServiceProvider;

class EdukaCubeServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->importMigrations();
        $this->registerObservers();
        $this->registerPolicies();
        $this->registerCommands();
        $this->activateFakes();
    }

    public function register()
    {
    }

    protected function activateFakes()
    {
        // Mail fake.
        if (config('eduka-cube.mail.fake') == 1) {
            Mail::fake();
        }
    }

    protected function importMigrations(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

    protected function registerObservers(): void
    {
        Video::observe(VideoObserver::class);
        Chapter::observe(ChapterObserver::class);
        User::observe(UserObserver::class);
        Subscriber::observe(SubscriberObserver::class);
        Course::observe(CourseObserver::class);
        ApplicationLog::observe(ApplicationLogObserver::class);
    }

    protected function registerPolicies(): void
    {
        //Gate::policy(Video::class, VideoPolicy::class);
    }

    protected function registerCommands(): void
    {
        $this->app->bind('command.eduka:fresh-seed', FreshSeed::class);

        $this->commands([
            'command.eduka:fresh-seed',
        ]);
    }
}
