<?php

namespace Eduka\Cube;

use Eduka\Abstracts\Classes\EdukaServiceProvider;
use Eduka\Cube\Commands\CreateCoupons;
use Eduka\Cube\Models\Chapter;
use Eduka\Cube\Models\Course;
use Eduka\Cube\Models\Domain;
use Eduka\Cube\Models\Group;
use Eduka\Cube\Models\Invoice;
use Eduka\Cube\Models\Link;
use Eduka\Cube\Models\Series;
use Eduka\Cube\Models\Subscriber;
use Eduka\Cube\Models\Tag;
use Eduka\Cube\Models\User;
use Eduka\Cube\Models\Variant;
use Eduka\Cube\Models\Video;
use Eduka\Cube\Observers\ChapterObserver;
use Eduka\Cube\Observers\CourseObserver;
use Eduka\Cube\Observers\DomainObserver;
use Eduka\Cube\Observers\GroupObserver;
use Eduka\Cube\Observers\InvoiceObserver;
use Eduka\Cube\Observers\LinkObserver;
use Eduka\Cube\Observers\SeriesObserver;
use Eduka\Cube\Observers\SubscriberObserver;
use Eduka\Cube\Observers\TagObserver;
use Eduka\Cube\Observers\UserObserver;
use Eduka\Cube\Observers\VariantObserver;
use Eduka\Cube\Observers\VideoObserver;
use Eduka\Cube\Policies\ChapterPolicy;
use Eduka\Cube\Policies\CoursePolicy;
use Eduka\Cube\Policies\DomainPolicy;
use Eduka\Cube\Policies\GroupPolicy;
use Eduka\Cube\Policies\InvoicePolicy;
use Eduka\Cube\Policies\LinkPolicy;
use Eduka\Cube\Policies\SeriesPolicy;
use Eduka\Cube\Policies\SubscriberPolicy;
use Eduka\Cube\Policies\TagPolicy;
use Eduka\Cube\Policies\UserPolicy;
use Eduka\Cube\Policies\VariantPolicy;
use Eduka\Cube\Policies\VideoPolicy;
use Illuminate\Support\Facades\Gate;

class CubeServiceProvider extends EdukaServiceProvider
{
    public function boot()
    {
        $this->registerObservers();
        $this->registerPolicies();
        $this->registerCommands();

        parent::boot();
    }

    public function register()
    {
    }

    protected function registerCommands()
    {
        $this->commands([
            CreateCoupons::class,
        ]);
    }

    protected function registerObservers()
    {
        User::observe(UserObserver::class);
        Course::observe(CourseObserver::class);
        Domain::observe(DomainObserver::class);
        Group::observe(GroupObserver::class);
        Series::observe(SeriesObserver::class);
        Invoice::observe(InvoiceObserver::class);
        Video::observe(VideoObserver::class);
        Series::observe(SeriesObserver::class);
        Chapter::observe(ChapterObserver::class);
        Tag::observe(TagObserver::class);
        Variant::observe(VariantObserver::class);
        Link::observe(LinkObserver::class);
        Subscriber::observe(SubscriberObserver::class);
    }

    protected function registerPolicies()
    {
        Gate::policy(User::class, UserPolicy::class);
        Gate::policy(Course::class, CoursePolicy::class);
        Gate::policy(Domain::class, DomainPolicy::class);
        Gate::policy(Group::class, GroupPolicy::class);
        Gate::policy(Series::class, SeriesPolicy::class);
        Gate::policy(Invoice::class, InvoicePolicy::class);
        Gate::policy(Video::class, VideoPolicy::class);
        Gate::policy(Series::class, SeriesPolicy::class);
        Gate::policy(Chapter::class, ChapterPolicy::class);
        Gate::policy(Tag::class, TagPolicy::class);
        Gate::policy(Variant::class, VariantPolicy::class);
        Gate::policy(Link::class, LinkPolicy::class);
        Gate::policy(Subscriber::class, SubscriberPolicy::class);
    }
}
