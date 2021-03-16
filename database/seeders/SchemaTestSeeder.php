<?php

namespace Eduka\Database\Seeders;

use Carbon\CarbonImmutable;
use Eduka\Cube\Models\Course;
use Eduka\Cube\Models\Subscriber;
use Eduka\Cube\Models\User;
use Illuminate\Database\Seeder;

class SchemaTestSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Lifespan will allow to better simulate operations along a specific
         * duration period. For instance, to simulate subscribers creation.
         */
        $lifeDuration = 3; // months
        $linkProbability = 30; // %

        $lifespan = CarbonImmutable::now()->subMonths(3);
        $seconds = $lifespan->diffInSeconds(now());

        Subscriber::factory(rand(100, 300))->make()->each(function ($subscriber) use ($seconds, $lifespan) {
            $subscriber->created_at = $lifespan->addSeconds(rand(1, $seconds));
            $subscriber->updated_at = $subscriber->created_at;
            $subscriber->saveQuietly();
        });

        User::factory(rand(10, 50))->make()->each(function ($user) use ($seconds, $lifespan, $linkProbability) {
            $user->created_at = $lifespan->addSeconds(rand(1, $seconds));
            $user->updated_at = $user->created_at;
            $user->saveQuietly();

            // Randomize user - subscriber linking.
            $prob = rand(1, 100);

            /*
             * Change the user email to one of the subscriber emails. The
             * subscriber observer will link both.
             */
            if ($prob < $linkProbability) {
                $subscriber = $this->pickAvailableSubscriber();
                $subscriber->email = $user->email;
                $subscriber->name = $user->name;
                $subscriber->saveQuietly();
            }
        });

        // Admin user.
        $admin = new User();
        $admin->name = 'Bruno Falcao';
        $admin->email_verified_at = now();
        $admin->email = 'bruno.falcao@live.com';
        $admin->password = bcrypt('honda');
        $admin->save();

        Course::create([
            'name' => 'Nova Advanced UI',
            'admin_email' => 'bruno.falcao@live.com',
        ]);
    }

    private function pickAvailableSubscriber()
    {
        return Subscriber::whereNotIn(
            'id',
            User::whereNotNull('subscriber_id')
                ->pluck('id')
        )
        ->inRandomOrder()
        ->first();
    }
}
