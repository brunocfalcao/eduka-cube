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
        Chapter::observe(ChapterObserver::class);
        Coupon::observe(CouponObserver::class);
        Course::observe(CourseObserver::class);
        Domain::observe(DomainObserver::class);
        Link::observe(LinkObserver::class);
        Order::observe(OrderObserver::class);
        Series::observe(SeriesObserver::class);
        Subscriber::observe(SubscriberObserver::class);
        Tag::observe(TagObserver::class);
        User::observe(UserObserver::class);
        Variant::observe(VariantObserver::class);
        VideoCompleted::observe(VideoCompletedObserver::class);
        Video::observe(VideoObserver::class);
        VideoStorage::observe(VideoStorageObserver::class);
    }

    protected function registerPolicies()
    {
        Gate::policy(Chapter::class, ChapterPolicy::class);
        Gate::policy(Coupon::class, CouponPolicy::class);
        Gate::policy(Course::class, CoursePolicy::class);
        Gate::policy(Domain::class, DomainPolicy::class);
        Gate::policy(Link::class, LinkPolicy::class);
        Gate::policy(Order::class, OrderPolicy::class);
        Gate::policy(Series::class, SeriesPolicy::class);
        Gate::policy(Subscriber::class, SubscriberPolicy::class);
        Gate::policy(Tag::class, TagPolicy::class);
        Gate::policy(User::class, UserPolicy::class);
        Gate::policy(Variant::class, VariantPolicy::class);
        Gate::policy(VideoCompleted::class, VideoCompletedPolicy::class);
        Gate::policy(Video::class, VideoPolicy::class);
        Gate::policy(VideoStorage::class, VideoStoragePolicy::class);
    }
}
