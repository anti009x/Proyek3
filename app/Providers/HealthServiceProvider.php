<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Spatie\Health\Facades\Health;
use Illuminate\Http\JsonResponse;
use Spatie\Health\Checks\Checks\DatabaseCheck;
use Spatie\Health\Checks\Checks\EnvironmentCheck;
use App\Checks\ServerStatus;
use Spatie\Health\Checks\Checks\ScheduleCheck;
use Spatie\Health\Checks\Checks\DebugModeCheck;
use App\Checks\CpuLoad;


class HealthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): JsonResponse
    {
       $health = Health::checks([
            DatabaseCheck::new(),
            ServerStatus::new(),
            EnvironmentCheck::new(),
            DebugModeCheck::new(),
            CpuLoad::new(),
            

   
       
        ]);

        if (strtoupper(substr(PHP_OS, 0, 3)) !== 'WIN') {
            $health->checks([CpuLoad::new()]);
        }

        return response()->json($health);

        // if ($this->app->environment('local')) {
        //     $checks[] = EnvironmentCheck::new();
        // }

        // Health::checks($checks);
    }
}
