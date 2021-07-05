<?php

namespace App\Providers;

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\ServiceProvider;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // fix error 403 if uncomment the line bellow
        // Broadcast::routes(['middleware' => ['auth']]);
        Broadcast::routes();

        require base_path('routes/channels.php');
    }
}
