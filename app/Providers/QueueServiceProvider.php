<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Queue\Events\JobFailed;

class QueueServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // listen to job processed and failed events
        \Queue::after(function (JobProcessed $event) {
            \Log::info('Job was done.');
            $payload = unserialize($event->job->payload()['data']['command']);
            $this->countStatJob($payload);
        });
        \Queue::failing(function (JobFailed $event) {
            \Log::info('Job was failed.');
            $payload = unserialize($event->job->payload()['data']['command']);
            $this->countStatJob($payload);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    private function countStatJob($payload)
    {
        $user = $payload->user;
        \Log::info('user info in the payload:' . $user->toJson());

        $count = \Cache::store('file')->increment('statistical');
        if ($count >= 50) {
            \Log::info('send notification to administrator');
        }
    }
}
